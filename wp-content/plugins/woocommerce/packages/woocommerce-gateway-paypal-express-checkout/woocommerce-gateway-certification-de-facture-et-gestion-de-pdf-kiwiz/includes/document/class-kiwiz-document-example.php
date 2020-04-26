<?php
/**
 * Kiwiz
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at the following URI:
 * https://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the PHP License and are unable to
 * obtain it through the web, please send a note to contact@kiwiz.io
 * so we can mail you a copy immediately.
 *
 * @author Kiwiz <contact@kiwiz.io>
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */


defined( 'ABSPATH' ) || exit;

/**
 * Class Kiwiz_Document_Example
 */

class Kiwiz_Document_Example extends Kiwiz_Document {

    private $_template_dir;
    protected $_document_name;

    public function __construct()
    {
        $this->_document_type   = 'example';
        $this->_template_dir    = $this->set_template_dir();
        $this->_document_name   = 'kiwiz-example.pdf';
    }

    private function set_template_dir() {
        return 'templates/example';
    }

    public function get_template_dir() {
        return $this->_template_dir;
    }

    /**
     * Set wp error messageF
     * @param $error
     */
    private function set_error( $error ) {
        $this->error = $error;
    }

    /**
     * Add body action
     */
    public function get_content_document() {
        add_action('kiwiz_example_body', array( $this, 'add_content' ) );
    }

    /**
     * Add document content
     */
    public function add_content() {
        add_action('kiwiz_document_example_shop_logo',          array( $this, 'add_shop_logo' ) );
        add_action('kiwiz_document_example_shop_info',          array( $this, 'add_shop_info' ) );
        add_action('kiwiz_document_example_shop_header',        array( $this, 'add_shop_header' ) );
        add_action('kiwiz_document_example_header',             array( $this, 'add_header' ) );
        add_action('kiwiz_document_example_details',            array( $this, 'add_details' ) );
        add_action('kiwiz_document_example_address',            array( $this, 'add_address' ) );
        add_action('kiwiz_document_example_shipping_address',   array( $this, 'add_shipping_address' ) );
        add_action('kiwiz_document_example_items',              array( $this, 'add_items' ) );

        wc_get_template( 'body.php', null, KIWIZ_PLUGIN_PATH.$this->_template_dir.'/', KIWIZ_PLUGIN_PATH.$this->_template_dir.'/' );
    }

    /**
     * Returns html code about the logo
     */
    public function add_shop_logo() {
        $shop_logo = $this->get_document_option('shop_pdf_logo');
        $logo = '<div class="shop-logo">';
        if ( isset( $shop_logo ) && $shop_logo != '' ) {
            $logo_img = $this->compress_image( $shop_logo, 'logo-document-kiwiz' );
            if ( $logo_img != null )
                $logo .= '<img src="' . $logo_img . '">';
        }
        $logo .= '</div>';
        echo $logo;
    }

    /**
     * Returns html code about the shop informations
     */
    public function add_shop_info() {
        $shop_pdf_name    = $this->get_document_option( ('shop_pdf_name') );
        $shop_pdf_address = $this->get_document_option( ('shop_pdf_address') );

        if ( ! isset( $shop_pdf_name ) && ! isset( $shop_pdf_address ) ) {
            return;
        }
        if ( isset( $shop_pdf_name ) ) {
            echo '<div class="shop-name">' . $shop_pdf_name . '</div>';
        }
        if ( isset ( $shop_pdf_address ) ) {
            echo '<div class="shop-address" > ' . nl2br($shop_pdf_address) . '</div> ';
        }
    }

    /**
     * Returns html code about custom shop header
     */
    public function add_shop_header() {
        $shop_pdf_header = $this->get_document_option( ('shop_pdf_header') );
        if ( ! isset( $shop_pdf_header ) || $shop_pdf_header == '' ) {
            return;
        }
        echo ' <tr><td class="document-header-data">' . $shop_pdf_header . '</td></tr>';
    }

    /**
     * Returns custom shop footer value
     */
    public function get_shop_footer() {
        return $this->get_document_option( ('shop_pdf_footer') );
    }

    /**
     * Returns html code about invoice and the order informations
     */
    public function add_header() {
        echo '<table>
            <tr class="document-number">
                <td>' . __( "Invoice n°", 'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) .' : 100000000</td>
                <td>' .__( "Order n°", 'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) .' : 100</td>
            </tr>
            <tr class="document-date">
                <td>' .__( "Invoice date", 'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) .' : '. date( parent::get_document_settings('shop_date_format')) .'</td>
                <td>' .__( "Order date", 'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) .' : '. date( parent::get_document_settings('shop_date_format')) .'</td>
            </tr>
        </table>';
    }

    /**
     * Returns html code about invoice shipping and payment method
     */
    public function add_details() {
        echo '<table>
            <tr>
                <td>' .__( "Payment method", 'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) .' : '.__( "Payment method name", 'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ).'</td>
            </tr>';

            echo '<tr>
                    <td>' . __("Shipping method", 'woocommerce-gateway-invoices-certification-pdf-system-kiwiz') . ' : '.__( "Shipping method name", 'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ).'</td>
                </tr>';

        echo '</table>';
    }

    /**
     * Returns html code about invoice address
     */
    public function add_address() {
        echo '<div class="invoice-address" > ';
        echo '<div class="title"> ' . __( "Invoice address", 'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) . '</div >Martin Dupond<br>1 rue de la paix<br>75000 PARIS<br>France</div> ';
    }

    /**
     * Returns html code about shipping address
     */
    public function add_shipping_address() {
        echo '<div class="shipping-address" > ';
        echo '<div class="title"> ' . __( "Shipping address", 'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) . '</div >Martin Dupond<br>1 rue de la paix<br>75000 PARIS<br>France</div> ';
    }

    /**
     * Add actions about order items and totals
     */
    public function add_items() {
        add_action('kiwiz_document_example_order_items', array( $this, 'add_order_items' ));
        wc_get_template( 'items.php', null, KIWIZ_PLUGIN_PATH.$this->_template_dir.'/', KIWIZ_PLUGIN_PATH.$this->_template_dir.'/' );

        add_action('kiwiz_document_example_order_totals', array( $this, 'add_order_totals' ));
        wc_get_template( 'totals.php', null, KIWIZ_PLUGIN_PATH.$this->_template_dir.'/', KIWIZ_PLUGIN_PATH.$this->_template_dir.'/' );
    }

    /**
     * Returns the html code of the header of the table containing the items of the order
     */
    public function get_items_table_head() {
        return '<tr class="thead">
            <td>'.  __( 'Products',   'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) .'</td>
            <td>'.  __( 'Sku',        'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) .'</td>
            <td class="ta-right">'.  __( 'Price',      'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) .'</td>
            <td class="ta-right">'.  __( 'Qty',        'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) .'</td>
            <td class="ta-right">'.  __( 'Tax',       'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) .'</td>
            <td class="ta-right">'.  __( 'Subtotal',   'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) .'</td>
        </tr>';
    }

    /**
     * Returns html code about order items
     */
    public function add_order_items() {
        echo '<table class="document-item">';
        echo $this->get_items_table_head();
        echo '<tr class="tbody">
        <td class="product_name">Produit 1</td>
        <td>REF001</td>
        <td class="ta-right">' .wc_price(25). '</td>
        <td class="ta-right">1</td>                
        <td class="ta-right">' .wc_price(5). '</td>
        <td class="ta-right">' .wc_price(30). '</td>
        </tr>';
        echo '</table>';
    }

    /**
     * Format item value
     */
    public function format_item_value( $item_value ) {
        return ($item_value != '') ? $item_value : '&nbsp;';
    }

    /**
     * Returns html code about order totals
     */
    public function add_order_totals() {

        //Add shipping
        echo '<tr class="shipping">
                <td class="column-product">' . __( "Shipping", 'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) .' :</td>
                <td class="column-total">' . wc_price( 12) . '</td>
            </tr>';

        //Add tax-free subtotal
        echo '<tr class="subtotal total-subtitle">
                <td class="column-product">' . __( "Subtotal Excl. Tax", 'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) . ' :</td>
                <td class="column-total">' . wc_price( 35 ) . '</td>
            </tr>';

        //Add taxes totals
        echo '<tr class="tax-rates total-subtitle">
                    <td class="column-product">' . __( "Tax Total", 'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) . ' :</td>
                    <td class="column-total">' . wc_price(7) . '</td>
                </tr>';
        echo '<tr class="tax-rates tax-rates-item">
                    <td class="column-product">TVA 20%:</td>
                    <td class="column-total">' . wc_price(7) . '</td>
                </tr>';

        //Add subtotal including taxes
        echo '<tr class="total">
            <td class="column-product">' . __( "Total", 'woocommerce-gateway-invoices-certification-pdf-system-kiwiz' ) .' :</td>
            <td class="column-total">' . wc_price(42 ) . '</td>
        </tr>';
    }


    /**
     * Add header action
     */
    public function get_header_document() {
        add_action('kiwiz_example_head', array( $this, 'add_style' ) );
    }
    /**
     * Add document style
     */
    public function add_style() {
        $style_file = KIWIZ_PLUGIN_PATH. $this->_template_dir . '/'. 'style.css';
        if ( file_exists( $style_file ) ) {
            echo '<link rel="stylesheet" type="text/css" href="' . $style_file . '">';
        }
    }

    /**
     * Prepare datas for the creation of the pdf
     */
    public function create_document() {

        $this->get_header_document();
        $this->get_content_document();

        ob_start();
        wc_get_template('main.php', null, KIWIZ_PLUGIN_PATH . $this->_template_dir . '/', KIWIZ_PLUGIN_PATH . $this->_template_dir . '/');
        $document = ob_get_contents();
        ob_end_clean();

        $this->generate_pdf_file($document, 'example', $this->_document_name);
        $this->flush_template();

    }

    /**
     * Clear all filters
     */
    public function flush_template() {
        remove_all_filters('kiwiz_document_example_shop_logo');
        remove_all_filters('kiwiz_document_example_shop_info');
        remove_all_filters('kiwiz_document_example_shop_header');
        remove_all_filters('kiwiz_document_example_header');
        remove_all_filters('kiwiz_document_example_details');
        remove_all_filters('kiwiz_document_example_address');
        remove_all_filters('kiwiz_document_example_shipping_address');
        remove_all_filters('kiwiz_document_example_items');
        remove_all_filters('kiwiz_example_body');
        remove_all_filters('kiwiz_document_example_order_items');
        remove_all_filters('kiwiz_document_example_order_totals');
        remove_all_filters('kiwiz_example_head');
    }

    /**
     * Return document content
     */
    public function get_document_content( $get_certify = false ) {
        return parent::get_document_content(false);
    }


}