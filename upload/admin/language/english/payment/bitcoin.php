<?php

/**
 * LICENSE
 *
 * This source file is subject to the GNU General Public License, Version 3
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @category   OpenCart
 * @package    Bitcoin Payment for OpenCart
 * @copyright  Copyright (c) 2015 Eugene Lifescale (a.k.a. Shaman) by OpenCart Ukrainian Community (http://opencart-ukraine.tumblr.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License, Version 3
 */

// Heading
$_['heading_title']         = 'BitCoin';

// Text
$_['text_payment']          = 'Payment';
$_['text_success']          = 'Success: You have modified BitCoin details!';
$_['text_edit']             = 'Edit BitCoin';
$_['text_google_api']       = 'Google API';
$_['text_bitcoin']          = '<a href="https://bitcoin.org" target="_blank"><img src="view/image/payment/bitcoin.png" alt="BitCoin" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_copyright']        = '<p><a href="https://github.com/shaman/opencart-bitcoin" target="_blank">BitCoin Payment for OpenCart</a></p><p>Version: 0.1.1</a></p><p>Donate BTC: <a href="bitcoin:1HdK2ppceaMvJSZqwEnQcpVaSe2xX3HYEa?label=BitCoin%20for%20OpenCart%20Donate">1HdK2ppceaMvJSZqwEnQcpVaSe2xX3HYEa</a></p>';


// Entry
$_['entry_total']           = 'Order Total';
$_['entry_order_status']    = 'Order Status';
$_['entry_geo_zone']        = 'Geo Zone';
$_['entry_status']          = 'Status';
$_['entry_sort_order']      = 'Sort Order';
$_['entry_user']            = 'RPC User';
$_['entry_password']        = 'RPC Password';
$_['entry_host']            = 'RPC Host';
$_['entry_port']            = 'RPC Port';
$_['entry_path']            = 'RPC Path';
$_['entry_qr']              = 'QR Code';
$_['entry_currency']        = 'BitCoin Currency';

// Help
$_['help_total']            = 'The checkout total the order must reach before this payment method becomes active.';
$_['help_user']             = 'Bitcoin RPC Username';
$_['help_password']         = 'Bitcoin RPC Password';
$_['help_host']             = 'Bitcoin RPC Host, localhost by default';
$_['help_port']             = 'Bitcoin RPC Port, 8332 by default';
$_['help_path']             = 'Bitcoin RPC Path, empty by default';
$_['help_qr']               = 'BitCoin Address will be formatted as additional QR Code';
$_['help_currency']         = 'Create, activate and change your BitCoin Currency';

// Error
$_['error_permission']      = 'Warning: You do not have permission to modify payment BitCoin!';
$_['error_response']        = 'Warning: Could not connect to BitCoin via RPC! Response: %s';
