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

class ControllerPaymentBitCoin extends Controller {

    private $error = array();

    public function index() {

        // Load dependencies
        $this->load->model('setting/setting');
        $data = $this->load->language('payment/bitcoin');

        // Validate & save changes
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('bitcoin', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));

        }

        // Display warnings if exists
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        // Build breadcrumbs
        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_payment'),
            'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('payment/bitcoin', 'token=' . $this->session->data['token'], 'SSL')
        );

        // Form processing
        $data['action'] = $this->url->link('payment/bitcoin', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        $this->load->model('localisation/order_status');
        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        $this->load->model('localisation/geo_zone');
        $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        $this->load->model('localisation/currency');
        $data['currencies'] = $this->model_localisation_currency->getCurrencies();

        if (isset($this->request->post['bitcoin_user'])) {
            $data['bitcoin_user'] = $this->request->post['bitcoin_user'];
        } else {
            $data['bitcoin_user'] = $this->config->get('bitcoin_user');
        }

        if (isset($this->request->post['bitcoin_password'])) {
            $data['bitcoin_password'] = $this->request->post['bitcoin_password'];
        } else {
            $data['bitcoin_password'] = $this->config->get('bitcoin_password');
        }

        if (isset($this->request->post['bitcoin_host'])) {
            $data['bitcoin_host'] = $this->request->post['bitcoin_host'];
        } else if ($this->config->get('bitcoin_host')) {
            $data['bitcoin_host'] = $this->config->get('bitcoin_host');
        } else {
            $data['bitcoin_host'] = 'localhost';
        }

        if (isset($this->request->post['bitcoin_port'])) {
            $data['bitcoin_port'] = $this->request->post['bitcoin_port'];
        } else if ($this->config->get('bitcoin_port')) {
            $data['bitcoin_port'] = $this->config->get('bitcoin_port');
        } else {
            $data['bitcoin_port'] = 8332;
        }

        if (isset($this->request->post['bitcoin_path'])) {
            $data['bitcoin_path'] = $this->request->post['bitcoin_path'];
        } else {
            $data['bitcoin_path'] = $this->config->get('bitcoin_path');
        }

        if (isset($this->request->post['bitcoin_total'])) {
            $data['bitcoin_total'] = $this->request->post['bitcoin_total'];
        } else {
            $data['bitcoin_total'] = $this->config->get('bitcoin_total');
        }

        if (isset($this->request->post['bitcoin_qr'])) {
            $data['bitcoin_qr'] = $this->request->post['bitcoin_qr'];
        } else {
            $data['bitcoin_qr'] = $this->config->get('bitcoin_qr');
        }

        if (isset($this->request->post['bitcoin_currency'])) {
            $data['bitcoin_currency'] = $this->request->post['bitcoin_currency'];
        } else {
            $data['bitcoin_currency'] = $this->config->get('bitcoin_currency');
        }

        if (isset($this->request->post['bitcoin_order_status_id'])) {
            $data['bitcoin_order_status_id'] = $this->request->post['bitcoin_order_status_id'];
        } else {
            $data['bitcoin_order_status_id'] = $this->config->get('bitcoin_order_status_id');
        }

        if (isset($this->request->post['bitcoin_geo_zone_id'])) {
            $data['bitcoin_geo_zone_id'] = $this->request->post['bitcoin_geo_zone_id'];
        } else {
            $data['bitcoin_geo_zone_id'] = $this->config->get('bitcoin_geo_zone_id');
        }

        if (isset($this->request->post['bitcoin_status'])) {
            $data['bitcoin_status'] = $this->request->post['bitcoin_status'];
        } else {
            $data['bitcoin_status'] = $this->config->get('bitcoin_status');
        }

        if (isset($this->request->post['bitcoin_sort_order'])) {
            $data['bitcoin_sort_order'] = $this->request->post['bitcoin_sort_order'];
        } else {
            $data['bitcoin_sort_order'] = $this->config->get('bitcoin_sort_order');
        }

        $this->document->setTitle($this->language->get('heading_title'));

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        // Load the template
        $this->response->setOutput($this->load->view('payment/bitcoin.tpl', $data));
    }

    protected function validate() {

        // Load dependencies
        $this->load->library('bitcoin');

        // Check permissions
        if (!$this->user->hasPermission('modify', 'payment/bitcoin')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        // Check connection
        $bitcoin = new BitCoin(
            $this->request->post['bitcoin_user'],
            $this->request->post['bitcoin_password'],
            $this->request->post['bitcoin_host'],
            $this->request->post['bitcoin_port'],
            $this->request->post['bitcoin_path']
        );

        if ($bitcoin->error) {
            $this->error['warning'] = sprintf($this->language->get('error_response'), $bitcoin->error);
        }

        return !$this->error;
    }
}
