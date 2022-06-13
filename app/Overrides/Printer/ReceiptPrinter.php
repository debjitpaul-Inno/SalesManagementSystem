<?php

namespace App\Overrides\Printer;

use App\Overrides\Printer\Item as Item;
use charlieuki\ReceiptPrinter\Store as Store;
use Exception;
use Mike42\Escpos\Printer;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

class ReceiptPrinter
{
    private $printer;
    private $logo;
    private $store;
    private $items;
    private $currency = 'BDT';
    private $subtotal = 0;
    private $tax_percentage = 0;
    private $tax = 0;
    private $grandtotal = 0;
    private $request_amount = 0;
    private $qr_code = [];
    private $bar_code = [];
    private $transaction_id = '';
    private $discount = 0;
    private $membership_discount_percentage = 0;
    private $membership_discount = 0;
    private $due = 0;

    function __construct() {
        $this->printer = null;
        $this->items = [];
    }

    public function init($connector_type, $connector_descriptor, $connector_port = 9100) {
        switch (strtolower($connector_type)) {
            case 'cups':
                $connector = new CupsPrintConnector($connector_descriptor);
                break;
            case 'windows':
                $connector = new WindowsPrintConnector($connector_descriptor);
                break;
            case 'network':
                $connector = new NetworkPrintConnector($connector_descriptor);
                break;
            default:
                $connector = new FilePrintConnector("php://stdout");
                break;
        }

        if ($connector) {
            // Load simple printer profile
            $profile = CapabilityProfile::load("default");
            // Connect to printer
            $this->printer = new Printer($connector, $profile);
        } else {
            throw new Exception('Invalid printer connector type. Accepted values are: cups');
        }
    }

    public function close() {
        if ($this->printer) {
            $this->printer->close();
        }
    }

    public function setStore($mid, $name, $address, $phone, $email) {
        $this->store = new Store($mid, $name, $address, $phone, $email);
    }

    public function setLogo($logo) {
        $this->logo = $logo;
    }

    public function setCurrency($currency) {
        $this->currency = $currency;
    }

    public function addItem($name, $qty, $price) {
        $item = new Item($name, $qty, $price);
        $item->setCurrency($this->currency);
        $this->items[] = $item;
    }

    public function setRequestAmount($amount) {
        $this->request_amount = $amount;
    }

    public function setTax($tax_percentage,$tax) {
        $this->tax_percentage = $tax_percentage;
        $this->tax = $tax;

    }
    public function setMembershipDiscount($membership_discount_percentage,$membership_discount) {
        $this->membership_discount_percentage = $membership_discount_percentage;
        $this->membership_discount = $membership_discount;
    }
    public function setDiscount($discount) {
        $this->discount = $discount;
    }
    public function setDue($due) {
        $this->due = $due;
    }

    public function calculateSubtotal() {
        $this->subtotal = 0;

        foreach ($this->items as $item) {
            $this->subtotal += (int) $item->getQty() * (int) $item->getPrice();
        }
    }

    public function calculateGrandTotal() {
        if ($this->subtotal == 0) {
            $this->calculateSubtotal();
        }

        $this->grandtotal = (int) $this->subtotal + (int) $this->tax - (int) $this->discount - (int) $this->membership_discount;
    }

    public function setTransactionID($transaction_id) {
        $this->transaction_id = $transaction_id;
    }

    public function setQRcode($content) {
        $this->qr_code = $content;
    }
    public function setBarcode($content) {
        $this->bar_code = $content;
    }

    public function setTextSize($width = 1, $height = 1) {
        if ($this->printer) {
            $width = ($width >= 10 && $width <= 8) ? (int) $width : 1;
            $height = ($height >= 1 && $height <= 8) ? (int) $height : 1;
            $this->printer->setTextSize($width, $height);
        }
    }

    public function getPrintableQRcode() {
        return json_encode($this->qr_code);
    }
    public function getPrintableBarcode() {
        return $this->bar_code['bar_code'];
    }

    public function getPrintableHeader($left_text, $right_text, $is_double_width = false) {
        $cols_width = $is_double_width ? 12 : 20;

        return str_pad($left_text, $cols_width) . str_pad($right_text, $cols_width, ' ', STR_PAD_LEFT);
    }

    public function getPrintableSummary($label, $value, $is_double_width = false) {
        $left_cols = $is_double_width ? 10 : 24;
        $right_cols = $is_double_width ? 10 : 23;

        $formatted_value =  number_format($value, 0, '.', ',').' '.$this->currency;

        return str_pad($label, $left_cols) . str_pad($formatted_value, $right_cols, ' ', STR_PAD_LEFT);
    }

    public function feed($feed = NULL) {
        $this->printer->feed($feed);
    }

    public function cut() {
        $this->printer->cut();
    }

    public function printDashedLine() {
        $line = '';

        for ($i = 0; $i < 32; $i++) {
            $line .= '-';
        }

        $this->printer->text($line);
    }

    public function printLogo() {
        if ($this->logo) {
            $image = EscposImage::load($this->logo, false);
        }
    }

    public function printQRcode() {
        if (!empty($this->qr_code)) {
            $this->printer->qrCode($this->getPrintableQRcode(), Printer::QR_ECLEVEL_L, 8);
        }
    }
    public function printBarcode() {
        if (!empty($this->bar_code)) {
            $this->printer->barcode($this->getPrintableBarcode(), Printer::BARCODE_UPCE,65);
        }
    }


    public function printReceipt($with_items = true) {
        if ($this->printer) {
            // Get total, subtotal, etc
            $subtotal = $this->getPrintableSummary('Subtotal', $this->subtotal);
            $tax = $this->getPrintableSummary('Tax('.$this->tax_percentage.'%)', $this->tax);
            $discount = $this->getPrintableSummary('Discount', $this->discount);
            $membership_discount = $this->getPrintableSummary('Membership Discount('.$this->membership_discount_percentage.'%)', $this->membership_discount);
            $due = $this->getPrintableSummary('Due', $this->due);
            $total = $this->getPrintableSummary('TOTAL', $this->grandtotal, true);
            $header = $this->getPrintableHeader(
                'TID: ' . $this->transaction_id,
                'MID: ' . $this->store->getMID()
            );
            $footer = "Thank you for shopping!\n";
            // Init printer settings
            $this->printer->initialize();
            $this->printer->selectPrintMode();
            // Set margins
            $this->printer->setPrintLeftMargin(4);
            // Print receipt headers
            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            // Print logo
            $this->printLogo();
            $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $this->printer->feed(2);
            $this->printer->text("{$this->store->getName()}\n");
            $this->printer->selectPrintMode();
            $this->printer->text("{$this->store->getAddress()}\n");
            $this->printer->text($header . "\n");
            $this->printer->feed();
            // Print receipt title
            $this->printer->setEmphasis(true);
            $this->printer->text("RECEIPT\n");
            $this->printer->setEmphasis(false);
            $this->printer->feed();
            // Print items
            if ($with_items) {
                $this->printer->setJustification(Printer::JUSTIFY_LEFT);
                foreach ($this->items as $item) {
                    $this->printer->text($item);
                    $this->printer->text("\n");
                }
                $this->printer->feed();
            }
            // Print subtotal
            $this->printer->setEmphasis(true);
            $this->printer->text($subtotal);
            $this->printer->setEmphasis(true);
            $this->printer->feed();
            // Print tax
            $this->printer->text($tax);
            $this->printer->feed();
            // Print Discount
            $this->printer->text($discount);
            $this->printer->feed();
            // Print Discount
            $this->printer->text($membership_discount);
            $this->printer->feed();
            // Print Due
            $this->printer->text($due);
            $this->printer->feed();
            // Print grand total
            $this->printer->text("\n");
            $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            $this->printer->text($total);
            $this->printer->feed();
            $this->printer->selectPrintMode();
            // Print qr code
            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            $this->printQRcode();
            // Print receipt footer
            $this->printer->feed();
            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            $this->printer->text($footer);
            $this->printer->feed();
            // Print receipt date
            $this->printer->text(date('j F Y H:i:s'));
            $this->printer->feed(2);
            // Cut the receipt
            $this->printer->cut();
            $this->printer->close();
        } else {
            throw new Exception('Printer has not been initialized.');
        }
    }

    public function printRequest() {
        if ($this->printer) {
            // Get request amount
            $total = $this->getPrintableSummary('TOTAL', $this->request_amount, true);
            $header = $this->getPrintableHeader(
                'TID: ' . $this->transaction_id,
                'MID: ' . $this->store->getMID()
            );
            $footer = "This is not a proof of payment.\n";
            // Init printer settings
            $this->printer->initialize();
            $this->printer->feed();
            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            // Print logo
            $this->printLogo();
            // Print receipt headers
            //$this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            //$this->printer->text("U L T I P A Y\n");
            //$this->printer->feed();
            $this->printer->selectPrintMode();
            $this->printer->text("{$this->store->getName()}\n");
            $this->printer->text("{$this->store->getAddress()}\n");
            $this->printer->text($header . "\n");
            $this->printer->feed();
            // Print receipt title
            $this->printDashedLine();
            $this->printer->setEmphasis(true);
            $this->printer->text("PAYMENT REQUEST\n");
            $this->printer->setEmphasis(false);
            $this->printDashedLine();
            $this->printer->feed();
            // Print instruction
            $this->printer->text("Please scan the code below\nto make payment\n");
            $this->printer->feed();
            // Print qr code
            $this->printQRcode();
            $this->printer->feed();
            // Print grand total
            $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $this->printer->text($total . "\n");
            $this->printer->feed();
            $this->printer->selectPrintMode();
            // Print receipt footer
            $this->printer->feed();
            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            $this->printer->text($footer);
            $this->printer->feed();
            // Print receipt date
            $this->printer->text(date('j F Y H:i:s'));
            $this->printer->feed(2);
            // Cut the receipt
            $this->printer->cut();
            $this->printer->close();
        } else {
            throw new Exception('Printer has not been initialized.');
        }
    }
    public function printBarRequest() {
        $this->printer->initialize();
        $this->printer->selectPrintMode();
        $this->printer->setJustification(Printer::JUSTIFY_CENTER);
        $this->printBarcode();
        $this->printer->feed(2);
        // Cut the receipt
        $this->printer->cut();
        $this->printer->close();
    }
}
