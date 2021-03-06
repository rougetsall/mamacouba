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
?>
<table class="document">
    <tr>
        <td>
            <table class="document-header">
                <tr>
                    <td class="logo">
                        <?php do_action( 'kiwiz_document_refund_shop_logo' ); ?>
                    </td>
                    <td class="info">
                        <?php do_action( 'kiwiz_document_refund_shop_info' ); ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table class="document-info">
                <?php do_action( 'kiwiz_document_refund_shop_header' ); ?>
                <tr>
                    <td class="datas">
                        <?php do_action( 'kiwiz_document_refund_header' ); ?>
                    </td>
                </tr>
                <tr>
                    <td class="details">
                        <?php do_action( 'kiwiz_document_invoice_details' ); ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table class="document-address">
                <tr>
                    <td>
                        <?php do_action( 'kiwiz_document_refund_address' ); ?>
                    </td>
                    <td>
                        <?php do_action( 'kiwiz_document_refund_shipping_address' ); ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <?php do_action( 'kiwiz_document_refund_items' ); ?>
        </td>
    </tr>
</table>
