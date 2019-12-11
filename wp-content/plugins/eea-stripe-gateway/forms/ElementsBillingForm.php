<?php
namespace EventEspresso\Stripe\forms;

use EE_Attendee;
use EE_Billing_Attendee_Info_Form;
use EE_Email_Validation_Strategy;
use EE_Error;
use EE_Float_Validation_Strategy;
use EE_Form_Section_HTML;
use EE_Form_Section_Proper;
use EE_Hidden_Input;
use EE_Payment_Method;
use EE_Registration;
use EE_Registry;
use EE_State_Select_Input;
use EE_Template_Layout;
use EE_Transaction;
use EEH_Money;
use EventEspresso\core\exceptions\InvalidDataTypeException;
use EventEspresso\core\exceptions\InvalidInterfaceException;
use EventEspresso\core\services\loaders\LoaderFactory;
use EventEspresso\Stripe\domain\Domain;
use InvalidArgumentException;
use ReflectionException;

/**
 * Class BillingForm
 *
 * Form for displaying Stripe billing form using Stripe Elements
 *
 * @package     Event Espresso
 * @author         Mike Nelson
 * @since         1.1.1.p
 *
 */
class ElementsBillingForm extends EE_Billing_Attendee_Info_Form
{
    /**
     * Filepath to template files
     * @var @template_path
     */
    protected $templatePath;

    /**
     * Whether or not we should request the payer's billing address.
     * @var boolean
     */
    protected $requestBillingAddress;

    /**
     * @var EE_Transaction
     */
    protected $transaction;

    /**
     * ElementsBillingForm constructor.
     * @param EE_Payment_Method $payment_method
     * @param array $options_array
     * @throws EE_Error
     * @throws InvalidDataTypeException
     * @throws InvalidInterfaceException
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    public function __construct(EE_Payment_Method $payment_method, array $options_array = array())
    {
        // Don't require they pass in a transaction. The billing form might just be instantiated for displaying in
        // the admin, where we don't need to know the transaction ID.
        $this->transaction = isset($options_array['transaction']) ? $options_array['transaction'] : null;
        if (! isset($options_array['template_path'])) {
            throw new EE_Error(
                sprintf(
                    esc_html__('%1$s instantiated without the needed template_path. Please provide it in $2$s', 'event_espresso'),
                    __CLASS__,
                    '$options_array[\'template_path\']'
                )
            );
        }
        $this->templatePath = $options_array['template_path'];
        $this->requestBillingAddress = isset($options_array['billing_address']) && $options_array['billing_address'];
        $options_array = array_replace_recursive(
            $options_array,
            array(
                'name' => 'Stripe_Payment_Intent_and_Elements_Form',
                // Add the new inputs...
                'subsections' => [
                    'debug_content'=> $this->generateBillingFormDebugContent($payment_method),
                    'state' => new EE_State_Select_Input(null, ['value_field_name' => 'STA_abbrev']),
                    'stripe_elements' => $this->stripeEmbeddedForm(),
                    'ee_stripe_payment_intent_id' => new EE_Hidden_Input(
                        array(
                            'html_id' => 'ee-stripe-payment-intent-id',
                            'html_name' => 'eeStripePaymentIntentId'
                        )
                    ),
                    'ee_stripe_payment_method_id' => new EE_Hidden_Input(
                        array(
                            'html_id' => 'ee-stripe-payment-method-id',
                            'html_name' => 'eeStripePaymentMethodId'
                        )
                    ),
                ],
                // ...and now let's specify their order.
                'include' => [
                    'debug',
                    'first_name',
                    'last_name',
                    'email',
                    'address',
                    'address2',
                    'city',
                    'state',
                    'country',
                    'zip',
                    'phone',
                    'stripe_elements',
                    'ee_stripe_payment_intent_id',
                    'ee_stripe_payment_method_id'
                ]
            )
        );
        if (! isset($options_array['billing_address']) || ! $options_array['billing_address']) {
            $options_array['exclude'] = [
                'address',
                'address2',
                'city',
                'state',
                'country',
                'zip',
                'phone'
            ];
        }
        parent::__construct($payment_method, $options_array);
    }

    /**
     *  Possibly adds debug content to Stripe billing form.
     *
     * @param EE_Payment_Method $payment_Method
     * @return string
     * @throws EE_Error
     */
    public function generateBillingFormDebugContent(EE_Payment_Method $payment_Method)
    {
        if ($payment_Method->debug_mode()) {
            return new EE_Form_Section_Proper(
                array(
                    'layout_strategy' => new EE_Template_Layout(
                        array(
                            'layout_template_file' => $this->templatePath . 'stripe_elements_debug_info.template.php',
                            'template_args' => array()
                        )
                    )
                )
            );
        }
        return new EE_Form_Section_HTML();
    }


    /**
     *  Use Stripe's Embedded form.
     *
     * @return EE_Form_Section_Proper
     * @throws \EE_Error
     */
    public function stripeEmbeddedForm()
    {
        $template_args = array();
        return new EE_Form_Section_Proper(
            array(
                'layout_strategy' => new EE_Template_Layout(
                    array(
                        'layout_template_file' => $this->templatePath . 'stripe_elements_form.template.php',
                        'template_args' => $template_args
                    )
                )
            )
        );
    }

    /**
     * EE core takes care of only enqueueing this billing form's JS (by calling this method) when we want
     * to display this billing form. This prevents issues when multiple Stripe Payment methods exist because Payment
     * Methods Pro is active.
     */
    public function enqueue_js()
    {
        parent::enqueue_js();
        wp_enqueue_style('espresso_stripe_payment_css', EE_STRIPE_URL . 'css' . DS . 'espresso_stripe.css');
        $registry = LoaderFactory::getLoader()->getShared('EventEspresso\core\services\assets\Registry');

        $js_url = $registry->getJsUrl('eventespresso-stripe', 'eventespresso-stripe-elements');
        wp_enqueue_script(
            'espresso_stripe_elements',
            $js_url,
            array('espresso_core', 'jquery', 'stripe_js', 'single_page_checkout'),
            EE_STRIPE_VERSION,
            true
        );
            $stripe_js_data = [
                'data_key' => $this->payment_method()->get_extra_meta(Domain::META_KEY_PUBLISHABLE_KEY, true),
                'data_name' => EE_Registry::instance()->CFG->organization->get_pretty('name'),
                'data_image' => $this->payment_method()->get_extra_meta(
                    'stripe_logo_url',
                    true,
                    EE_Registry::instance()->CFG->organization->get_pretty('logo_url')
                ),
                'data_locale' => $this->payment_method()->get_extra_meta('data_locale', true),
                'data_currency' => EE_Registry::instance()->CFG->currency->code,
                'no_SPCO_error' => esc_html__('It appears the Single Page Checkout javascript was not loaded properly! Please refresh the page and try again or contact support.', 'event_espresso'),
                'no_stripe_error' => esc_html__('It appears the Stripe JS was not loaded properly! Please refresh the page and try again or contact support.', 'event_espresso'),
                'payment_method_slug' => $this->payment_method()->slug(),
                'unit_to_subunit_conversion' => pow(10, $this->payment_method()->type_obj()->get_gateway()->get_stripe_decimal_places(EE_Registry::instance()->CFG->currency->code)),
                'billing_selectors' => [
                    'first_name' => $this->get_input('first_name')->html_id(true),
                    'last_name' => $this->get_input('last_name')->html_id(true),
                    'address' => $this->has_subsection('address') ? $this->get_input('address')->html_id(true) : '',
                    'address2' => $this->has_subsection('address') ? $this->get_input('address2')->html_id(true) : '',
                    'city' => $this->has_subsection('address') ? $this->get_input('city')->html_id(true) : '',
                    'state' => $this->has_subsection('address') ? $this->get_input('state')->html_id(true) : '',
                    'country' => $this->has_subsection('address') ? $this->get_input('country')->html_id(true) : '',
                    'zip' => $this->has_subsection('address') ? $this->get_input('zip')->html_id(true) : '',
                    'email' => $this->has_subsection('address') ? $this->get_input('email')->html_id(true) : '',
                    'phone' => $this->has_subsection('address') ? $this->get_input('phone')->html_id(true) : '',
                ],
                // The transaction ID is only used for logging errors. So it's not absolutely essential if it wasn't set.
                'txn_id' => $this->transaction instanceof EE_Transaction ? $this->transaction->ID() : 0,
                'ajax_url' =>  admin_url( 'admin-ajax.php' )
            ];
            if ($this->payment_method()->debug_mode()) {
                $stripe_js_data['data_cc_number'] = '4242424242424242';
                $stripe_js_data['data_exp_month'] = date('m');
                $stripe_js_data['data_exp_year'] = date('Y') + 4;
                $stripe_js_data['data_cvc'] = '248';
            }

        // Filter JS data.
            $stripe_js_data = apply_filters('FHEE__EE_PMT_Stripe_Onsite__enqueue_stripe_payment_scripts__js_data', $stripe_js_data, $this->payment_method());


        // Data needed in the JS.
        // Dont' use `$registry->addData()` because that would require the JS to depend on `eejs` which would make it
        // depend on Gutenberg being installed.
        wp_localize_script(
            'espresso_stripe_elements',
            'stripeElementsArgs',
            $stripe_js_data
        );
    }
}
