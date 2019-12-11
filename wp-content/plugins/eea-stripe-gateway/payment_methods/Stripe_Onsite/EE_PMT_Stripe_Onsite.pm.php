<?php
use EventEspresso\Stripe\domain\Domain;
use EventEspresso\Stripe\forms\BillingForm;
use EventEspresso\Stripe\forms\ElementsBillingForm;

/**
 *
 * EE_PMT_Onsite
 *
 *
 * @package            Event Espresso
 * @subpackage        espresso-stripe-gateway
 * @author            Event Espresso
 *
 */
class EE_PMT_Stripe_Onsite extends EE_PMT_Base
{

    /**
     * path to the templates folder for the Stripe PM
     * @var string
     */
    protected $_template_path = null;


    /**
     *
     * @param EE_Payment_Method $pm_instance
     * @throws \EE_Error
     * @return \EE_PMT_Stripe_Onsite
     */
    public function __construct($pm_instance = null)
    {
        $this->_pretty_name = esc_html__("Stripe", 'event_espresso');
        $this->_default_description = esc_html__('Click the "Pay Now" button to proceed with payment.', 'event_espresso');
        $this->_template_path = dirname(__FILE__) . DS . 'templates' . DS;
        $this->_requires_https = false;
        $this->_default_button_url = EE_STRIPE_URL . 'payment_methods' . DS . 'Stripe_Onsite' . DS . 'lib' . DS . 'stripe-cc-logo.png';

        require_once($this->file_folder() . 'EEG_Stripe_Onsite.gateway.php');
        $this->_gateway = new EEG_Stripe_Onsite();

        parent::__construct($pm_instance);
    }


    /**
     * Generate a new payment settings form.
     *
     * @return EE_Payment_Method_Form
     */
    public function generate_new_settings_form()
    {
        $pms_form = new EE_Payment_Method_Form(array(
            'extra_meta_inputs' => array(
                Domain::META_KEY_SECRET_KEY => new EE_Text_Input(array(
                    'html_label_text' => sprintf(esc_html__("Stripe Secret Key %s", "event_espresso"), $this->get_help_tab_link())
                )),
                Domain::META_KEY_PUBLISHABLE_KEY => new EE_Text_Input(array(
                    'html_label_text' => sprintf(esc_html__("Stripe Publishable Key %s", "event_espresso"), $this->get_help_tab_link())
                )),
                'integration' => new EE_Select_Input(
                    [
                        'checkout' => esc_html__('Stripe Checkout (legacy)', 'event_espresso'),
                        'elements' => esc_html__('Stripe Elements', 'event_espresso')
                    ],
                    [
                        'html_label_text' => esc_html__('Integration Type', 'event_espresso'),
                        'required' => true,
                        'default' => 'elements',
                        'html_help_text' => sprintf(
                            // @translators: %1$s opening HTML anchor tag %2$s closing HTML anchor tag
                            // @codingStandardsIgnoreStart
                            esc_html__('Stripe Elements is recommended for all merchants. Payments made by European customers using legacy Stripe Checkout may be rejected because %1$sit does not support Strong Customer Authentication (SCA)%2$s.', 'event_espresso'),
                            // @codingStandardsIgnoreEnd
                            '<a href="https://stripe.com/en-ca/payments/strong-customer-authentication" target="_blank" rel="noopener noreferrer">',
                            '</a>'
                        ),
                        'html_class' => 'stripe-integration'
                    ]
                ),
                'validate_zip' => new EE_Yes_No_Input(
                    array(
                        'html_label_text' => sprintf(esc_html__("Validate the billing ZIP code? %s", 'event_espresso'), $this->get_help_tab_link()),
                        'default' => false,
                        'required' => true,
                        'html_class' => 'validate-zip'
                    )
                ),
                'billing_address' => new EE_Yes_No_Input(
                    array(
                        'html_label_text' => sprintf(esc_html__("Collect the user's billing address? %s", 'event_espresso'), $this->get_help_tab_link()),
                        'default' => false,
                        'required' => true
                    )
                ),
                'data_locale' => new EE_Select_Input(
                    array(
                        null => esc_html__('None', 'event_espresso'),
                        'auto' => esc_html__('Auto (Defaults to English)', 'event_espresso'),
                        'zh' => esc_html__('Simplified Chinese', 'event_espresso'),
                        'da' => esc_html__('Danish', 'event_espresso'),
                        'nl' => esc_html__('Dutch', 'event_espresso'),
                        'en' => esc_html__('English', 'event_espresso'),
                        'fi' => esc_html__('Finnish', 'event_espresso'),
                        'fr' => esc_html__('French', 'event_espresso'),
                        'de' => esc_html__('German', 'event_espresso'),
                        'it' => esc_html__('Italian', 'event_espresso'),
                        'ja' => esc_html__('Japanese', 'event_espresso'),
                        'no' => esc_html__('Norwegian', 'event_espresso'),
                        'es' => esc_html__('Spanish', 'event_espresso'),
                        'sv' => esc_html__('Swedish', 'event_espresso')
                    ),
                    array(
                        'html_label_text' => sprintf(esc_html__("Checkout locale %s", 'event_espresso'), $this->get_help_tab_link()),
                        'html_help_text' => esc_html__("This is the locale sent to Stripe to determine which language the checkout modal should use.", 'event_espresso')
                    )
                ),
                'stripe_logo_url' => new EE_Admin_File_Uploader_Input(array(
                        'html_label_text' => sprintf(esc_html__("Logo URL %s", "event_espresso"), $this->get_help_tab_link()),
                        'default' => EE_Registry::instance()->CFG->organization->get_pretty('logo_url'),
                        'html_help_text' => esc_html__("(Logo shown on Stripe checkout)", 'event_espresso'),
                    ))
            )
        ));



        // Filtering the form contents.
        $pms_form = apply_filters('FHEE__EE_PMT_Stripe_Onsite__generate_new_settings_form__form_filtering', $pms_form, $this, $this->_pm_instance);

        return $pms_form;
    }


    /**
     * Creates a billing form for this payment method type.
     * @param \EE_Transaction $transaction
     * @return \EE_Billing_Info_Form
     */
    public function generate_new_billing_form(EE_Transaction $transaction = null, $extra_args = array())
    {
        // If the site was saved to use Elements, use it. If they haven't set it, fall back to Checkout.
        if ($this->_pm_instance->get_extra_meta('integration', true) === 'elements') {
            $billing_form = new ElementsBillingForm(
                $this->_pm_instance,
                array_merge(
                    array(
                        'transaction' => $transaction,
                        'template_path' => $this->_template_path,
                        'billing_address' => $this->_pm_instance->get_extra_meta('billing_address', true)
                    ),
                    $extra_args
                )
            );
        } else {
            // provide amount_owing and transaction
            $billing_form = new BillingForm(
                $this->_pm_instance,
                array_merge(
                    array(
                        'transaction' => $transaction,
                        'template_path' => $this->_template_path
                    ),
                    $extra_args
                )
            );
        }

        return $this->apply_billing_form_debug_settings($billing_form);
    }


    /**
     *  Possibly adds debug content to Stripe billing form. Is called by SPCO (somewhat inconsistently IMO)
     *
     * @return string
     */
    public function apply_billing_form_debug_settings(EE_Billing_Info_Form $billing_form)
    {
        if ($this->_pm_instance->debug_mode()) {
            $template = $this->_pm_instance->get_extra_meta('integration', true) === 'elements' ? 'stripe_elements_debug_info.template.php' : 'stripe_debug_info.template.php';
            $billing_form->add_subsections(
                array(
                    'debug_content' => new EE_Form_Section_HTML_From_Template(
                        $this->_template_path . $template,
                        array()
                    )
                ),
                'first_name'
            );
        }
        return $billing_form;
    }


    /**
     *  Use Stripe's Embedded form.
     *
     * @return EE_Form_Section_Proper
     * @deprecated in 1.1.1.p. Instead EventEspresso\Stripe\payment_methods\Stripe_Onsite\forms\BillingForm takes care of this
     */
    public function stripe_embedded_form()
    {
        $template_args = array();
        return new EE_Form_Section_Proper(
            array(
                'layout_strategy' => new EE_Template_Layout(
                    array(
                        'layout_template_file' => $this->_template_path . 'stripe_embedded_form.template.php',
                        'template_args' => $template_args
                    )
                )
            )
        );
    }


    /**
     * Adds the help tab
     *
     * @see EE_PMT_Base::help_tabs_config()
     * @return array
     */
    public function help_tabs_config()
    {
        return array(
            $this->get_help_tab_name() => array(
                'title' => esc_html__('Stripe Settings', 'event_espresso'),
                'filename' => 'payment_methods_overview_stripe'
            ),
        );
    }


    /**
     * Log Stripe TXN Error.
     *
     * @return void
     */
    public static function log_stripe_error()
    {
        if (isset($_POST['txn_id']) && !empty($_POST['txn_id'])) {
            $stripe_pm = EEM_Payment_method::instance()->get_one_of_type('Stripe_Onsite');
            $transaction = EEM_Transaction::instance()->get_one_by_ID($_POST['txn_id']);
            $stripe_pm->type_obj()->get_gateway()->log(array('Stripe JS Error (Transaction: ' . $transaction->ID() . ')' => $_POST['message']), $transaction);
        }
    }
}
