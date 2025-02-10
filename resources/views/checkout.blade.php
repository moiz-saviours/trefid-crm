<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/css/checkout.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


    <!-- pdf download links -->
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>
<body>
<div id="toaster-container"></div>
<?php
if (!$invoiceDetails['success']) {
    $message = json_encode($invoiceDetails['error']);
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                const container = document.getElementById('toaster-container');
                const toast = document.createElement('div');
                toast.className = 'toaster error';
                toast.textContent = '$message';
                container.appendChild(toast);
                setTimeout(() => toast.remove(), 4000);
            });
        </script>";
    exit();
}
$invoiceData = $invoiceDetails['invoice'] ?? [];
$currency = $invoiceDetails['invoice']['currency'] ?? "";
$currency = [
    'USD' => '$',
    'GBP' => '£',
    'AUD' => 'A$',
    'CAD' => 'C$'
][$currency] ?? '';
$amount = number_format($invoiceData['amount'] ?? 0, 2);
$taxable = $invoiceData['taxable'] ?? 0;
$tax_type = $invoiceData['tax_type'] == 'percentage' ? '%' : ($invoiceData['tax_type'] == 'fixed' ? $currency : '');
$tax_value = $invoiceData['tax_value'] ?? 0;
$tax_amount = number_format($invoiceData['tax_amount'] ?? 0, 2);
$total_amount = number_format($invoiceData['total_amount'] ?? 0, 2);
$description = htmlspecialchars($invoiceData['description'] ?? 'N/A', ENT_QUOTES, 'UTF-8');
$status = $invoiceData['status'] ?? 0;
$dueDate = new DateTime($invoiceData['due_date'] ?? 'now');
$currentDate = new DateTime();
$brandData = $invoiceData['brand'] ?? [];
$countries = ['US' => 'United States', 'AF' => 'Afghanistan', 'AL' => 'Albania', 'DZ' => 'Algeria', 'AS' => 'American Samoa', 'AD' => 'Andorra', 'AO' => 'Angola', 'AI' => 'Anguilla', 'AG' => 'Antigua and Barbuda', 'AR' => 'Argentina', 'AM' => 'Armenia', 'AW' => 'Aruba', 'AU' => 'Australia', 'AT' => 'Austria', 'AZ' => 'Azerbaijan', 'BS' => 'Bahamas', 'BH' => 'Bahrain', 'BD' => 'Bangladesh', 'BB' => 'Barbados', 'BY' => 'Belarus', 'BE' => 'Belgium', 'BZ' => 'Belize', 'BJ' => 'Benin', 'BM' => 'Bermuda', 'BT' => 'Bhutan', 'BO' => 'Bolivia', 'BA' => 'Bosnia and Herzegovina', 'BW' => 'Botswana', 'BR' => 'Brazil', 'BN' => 'Brunei', 'BG' => 'Bulgaria', 'BF' => 'Burkina Faso', 'BI' => 'Burundi', 'CV' => 'Cabo Verde', 'KH' => 'Cambodia', 'CM' => 'Cameroon', 'CA' => 'Canada', 'KY' => 'Cayman Islands', 'CF' => 'Central African Republic', 'TD' => 'Chad', 'CL' => 'Chile', 'CN' => 'China', 'CO' => 'Colombia', 'KM' => 'Comoros', 'CG' => 'Congo', 'CD' => 'Congo (Democratic Republic)', 'CR' => 'Costa Rica', 'HR' => 'Croatia', 'CU' => 'Cuba', 'CY' => 'Cyprus', 'CZ' => 'Czech Republic', 'DK' => 'Denmark', 'DJ' => 'Djibouti', 'DM' => 'Dominica', 'DO' => 'Dominican Republic', 'EC' => 'Ecuador', 'EG' => 'Egypt', 'SV' => 'El Salvador', 'GQ' => 'Equatorial Guinea', 'ER' => 'Eritrea', 'EE' => 'Estonia', 'SZ' => 'Eswatini', 'ET' => 'Ethiopia', 'FJ' => 'Fiji', 'FI' => 'Finland', 'FR' => 'France', 'GA' => 'Gabon', 'GM' => 'Gambia', 'GE' => 'Georgia', 'DE' => 'Germany', 'GH' => 'Ghana', 'GR' => 'Greece', 'GD' => 'Grenada', 'GU' => 'Guam', 'GT' => 'Guatemala', 'GN' => 'Guinea', 'GW' => 'Guinea-Bissau', 'GY' => 'Guyana', 'HT' => 'Haiti', 'HN' => 'Honduras', 'HU' => 'Hungary', 'IS' => 'Iceland', 'IN' => 'India', 'ID' => 'Indonesia', 'IR' => 'Iran', 'IQ' => 'Iraq', 'IE' => 'Ireland', 'IL' => 'Israel', 'IT' => 'Italy', 'JM' => 'Jamaica', 'JP' => 'Japan', 'JO' => 'Jordan', 'KZ' => 'Kazakhstan', 'KE' => 'Kenya', 'KI' => 'Kiribati', 'KP' => 'North Korea', 'KR' => 'South Korea', 'KW' => 'Kuwait', 'KG' => 'Kyrgyzstan', 'LA' => 'Laos', 'LV' => 'Latvia', 'LB' => 'Lebanon', 'LS' => 'Lesotho', 'LR' => 'Liberia', 'LY' => 'Libya', 'LI' => 'Liechtenstein', 'LT' => 'Lithuania', 'LU' => 'Luxembourg', 'MG' => 'Madagascar', 'MW' => 'Malawi', 'MY' => 'Malaysia', 'MV' => 'Maldives', 'ML' => 'Mali', 'MT' => 'Malta', 'MH' => 'Marshall Islands', 'MR' => 'Mauritania', 'MU' => 'Mauritius', 'MX' => 'Mexico', 'FM' => 'Micronesia', 'MD' => 'Moldova', 'MC' => 'Monaco', 'MN' => 'Mongolia', 'ME' => 'Montenegro', 'MA' => 'Morocco', 'MZ' => 'Mozambique', 'MM' => 'Myanmar', 'NA' => 'Namibia', 'NR' => 'Nauru', 'NP' => 'Nepal', 'NL' => 'Netherlands', 'NZ' => 'New Zealand', 'NI' => 'Nicaragua', 'NE' => 'Niger', 'NG' => 'Nigeria', 'MK' => 'North Macedonia', 'NO' => 'Norway', 'OM' => 'Oman', 'PK' => 'Pakistan', 'PW' => 'Palau', 'PA' => 'Panama', 'PG' => 'Papua New Guinea', 'PY' => 'Paraguay', 'PE' => 'Peru', 'PH' => 'Philippines', 'PL' => 'Poland', 'PT' => 'Portugal', 'QA' => 'Qatar', 'RO' => 'Romania', 'RU' => 'Russia', 'RW' => 'Rwanda', 'WS' => 'Samoa', 'SM' => 'San Marino', 'SA' => 'Saudi Arabia', 'SN' => 'Senegal', 'RS' => 'Serbia', 'SC' => 'Seychelles', 'SL' => 'Sierra Leone', 'SG' => 'Singapore', 'SK' => 'Slovakia', 'SI' => 'Slovenia', 'SB' => 'Solomon Islands', 'SO' => 'Somalia', 'ZA' => 'South Africa', 'ES' => 'Spain', 'LK' => 'Sri Lanka', 'SD' => 'Sudan', 'SR' => 'Suriname', 'SE' => 'Sweden', 'CH' => 'Switzerland', 'SY' => 'Syria', 'TW' => 'Taiwan', 'TJ' => 'Tajikistan', 'TZ' => 'Tanzania', 'TH' => 'Thailand', 'TL' => 'Timor-Leste', 'TG' => 'Togo', 'TO' => 'Tonga', 'TT' => 'Trinidad and Tobago', 'TN' => 'Tunisia', 'TR' => 'Turkey', 'TM' => 'Turkmenistan', 'TV' => 'Tuvalu', 'UG' => 'Uganda', 'UA' => 'Ukraine', 'AE' => 'United Arab Emirates', 'GB' => 'United Kingdom', 'US' => 'United States', 'UY' => 'Uruguay', 'UZ' => 'Uzbekistan', 'VU' => 'Vanuatu', 'VA' => 'Vatican City', 'VE' => 'Venezuela', 'VN' => 'Vietnam', 'YE' => 'Yemen', 'ZM' => 'Zambia', 'ZW' => 'Zimbabwe'];
?>

<section class="invoice-template py-5">
    <div class="container-fluid">
        <div class="row first-row">
            <div class="col-md-12">
                <div class="icon">
                    <img src="{{asset('assets/images/other/printer-svgrepo-com.svg')}}" alt="" class="icon-i"
                         onclick="printDiv('invoice')">
                    <img src="{{asset('assets/images/other/down-line-svgrepo-com.svg')}}" alt="" class="icon-i2"
                         onclick="generatePDF()">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class=" col-lg-6 col-12">

                <div class="box-shade ">
                    <div id="invoice">

                        <div class="invoice-info">
                            <div class="row align-items-end">
                                <div class="ribbon">
                                    <?php
                                    if ($status == 1) {
                                        echo '<div class="ribbon-inner ribbon-paid">Paid</div>';
                                    } elseif ($dueDate < $currentDate) {
                                        echo '<div class="ribbon-inner ribbon-overdue">Overdue</div>';
                                    } else {
                                        echo '<div class="ribbon-inner ribbon-unpaid">Unpaid</div>';
                                    }
                                    ?>
                                </div>
                                <div class="col-md-6 col-4">
                                    <div class="brand-logo">
                                        <img
                                                src="<?= htmlspecialchars($brandData['logo'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                class="img-fluid" class="images">
                                    </div>
                                </div>
                                <div class="col-md-6 col-8 text-right ">
                                    <div class="invoice-detail">
                                        <h1>Invoice</h1>
                                        <h4>Invoice
                                            Number# <?= htmlspecialchars($invoiceData['invoice_number'] ?? '', ENT_QUOTES, 'UTF-8') ?></h4>
                                        <h4>Invoice Key
                                            # <?= htmlspecialchars($invoiceData['invoice_key'] ?? '', ENT_QUOTES, 'UTF-8') ?></h4>
                                        <?php
                                        if ($status != 1) {
                                            echo '<h5>Balance Due</h5>
                                        <h6>' . $currency . $amount . '</h6>';
                                        } else {
                                            echo '<h5>Invoice Paid</h5>';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="brandname"><?= htmlspecialchars($brandData['name'] ?? '', ENT_QUOTES, 'UTF-8') ?></h2>
                                    <p><?= htmlspecialchars($brandData['description'] ?? 'N/A', ENT_QUOTES, 'UTF-8') ?></p>
                                    <p>
                                        Email: <?= htmlspecialchars($brandData['email'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                                </div>
                                <!--                            <div class="col-md-6 text-right">-->
                                <!--                                <p>Invoice-->
                                <!--                                    Date: -->
                                <?php //= htmlspecialchars($invoiceData['created_at'] ?? '', ENT_QUOTES, 'UTF-8') ?><!--</p>-->
                                <!--                                <p>Due-->
                                <!--                                    Date: -->
                                <?php //= htmlspecialchars($invoiceData['due_date'] ?? '', ENT_QUOTES, 'UTF-8') ?><!--</p>-->
                                <!--                            </div>-->

                                <div
                                        class="col-md-6 <?= $invoiceDetails['invoice']['status'] == 1 ? '' : 'd-none' ?>"
                                        style="display: flex;justify-content: flex-end;">
                                    <img src="./images/pngwing.com.png" alt="" class="paid mr-5">
                                </div>
                            </div>
                            <div class="row align-items-end third-col mt-3">
                                <div class="col-md-6 containeree">
                                    <h5>Bill To,</h5>
                                    <div class="row">
                                        <div class="col-md-3 col-4">
                                            <div class="para-1">
                                                <p>name:</p>
                                                <p>email: </p>
                                                <p>phone:</p>
                                                <!-- <p>address:</p>
                                                <p>country:</p> -->

                                            </div>
                                        </div>

                                        <div class="col-md-9 col-8">
                                            <div class="para-2">
                                                <p> <?= $invoiceDetails['invoice']['customer']['name'] ?? '' ?></p>
                                                <p> <?= $invoiceDetails['invoice']['customer']['email'] ?? '' ?></p>
                                                <p> <?= $invoiceDetails['invoice']['customer']['phone'] ?? '' ?></p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 invoice-balance-text">
                                    <div class="row">
                                        <div class="col-md-5 col-4">
                                            <p><b>Invoice
                                                    Date:</b></p>
                                            <p><b>Due
                                                    Date:</b></p>
                                        </div>

                                        <div class="col-md-7 col-8">

                                            <p> <?= htmlspecialchars($invoiceData['created_at'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                                            <p> <?= htmlspecialchars($invoiceData['due_date'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>

                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab">
                            <div class="row ">
                                <div class="col-md-12 ">
                                    <div class="table-responsive">
                                        <table class="table custom-invoice-table">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col" class="roww">#</th>
                                                <th scope="col col-width-1">Description</th>
                                                <th scope="col col-width-2"></th>
                                                <th scope="col col-width-2"></th>
                                                <th scope="col">Amount</th>


                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td class=""><?= $description ?></td>
                                                <td class=""></td>
                                                <td class=""></td>
                                                <td class=" amount"><?= $currency . $amount ?></td>
                                                <!-- <td class="col-width-1"><?= $description ?></td>
                                        <td class="col-width-2"></td>
                                        <td class="col-width-2"></td>
                                        <td class="col-width-1 amount"><?= $currency . $amount ?></td> -->

                                            </tr>
                                            <!-- Tax Amount -->
                                            <tr>
                                                <th scope="row" class="roww"></th>
                                                <td class="roww"></td>
                                                <td class="roww"></td>
                                                <td class="roww">Tax :
                                                    &nbsp;<?= $taxable ? ($tax_type . $tax_value) : "" ?></td>
                                                <td class="roww amount"><?= $currency . $tax_amount ?></td>
                                            </tr>
                                            <!-- Tax Amount-->

                                            <!-- Subtotal Row -->
                                            <tr>
                                                <th scope="row" class="roww"></th>
                                                <td class="roww"></td>
                                                <td class="roww"></td>
                                                <td class="roww">Sub total</td>
                                                <td class="roww amount"><?= $currency . $amount ?></td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="roww"></th>
                                                <td class="roww"></td>
                                                <td class="roww"></td>
                                                <td class="td" class="roww"><b>total</b></td>
                                                <td class="td amount" class="roww">
                                                    <b><?= $currency . $total_amount ?></b></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"></th>
                                                <td></td>
                                                <td id="td"></td>
                                                <td id="td"><b>Balance Due</b></td>
                                                <td class="td amount" id="td">
                                                    <b><?= $currency . ($status != 1 ? $total_amount : "0.00") ?></b>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-end">
                            <p>Thanks for your business.</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12 <?= $invoiceDetails['invoice']['status'] == 1 ? 'd-none' : '' ?>">
                <div class="box-shade-2">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="header-btns-heading-wrapper">
                                <div class="form-txt" id="form-txt-1">
                                    <h1>Card Details</h1>
                                    <p>your card details are shared securely via SSL for payment processing. <br>
                                        we do not store your card details on our server.</p>
                                </div>
                                <div class="side-bar header-btns-div">
                                    <!-- <div class="nav  nav-pills side-bar" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical"> -->
                                    <?php if (in_array('credit_card', $invoiceDetails['invoice']['payment_methods'])): ?>
                                            <!-- <button class="nav-link active" id="v-pills-credit-card-tab" data-toggle="pill"
                                                data-target="#v-pills-credit-card" type="button" role="tab"
                                                aria-controls="v-pills-credit-card"
                                                aria-selected="false">Credit Card
                                        </button> -->
                                    <?php endif; ?>


                                    <?php if (in_array('paypal', $invoiceDetails['invoice']['payment_methods'])): ?>
                                    {{--                                    <button class="paypal-payment-btn">--}}
                                    {{--                                        <img src="./images/paypal.png" class="img-fluid payment-imgs">--}}
                                    {{--                                    </button>--}}
                                    <!-- <button class="nav-link payment-btns" id="v-pills-paypal-tab" data-toggle="pill"
                                            data-target="#v-pills-paypal" type="button" role="tab"
                                            aria-controls="v-pills-paypal"
                                            aria-selected="true">
                                            <img src="./images/paypal.png"  class="img-fluid payment-imgs">
                                    </button> -->
                                    <?php endif; ?>
                                            <!--  <button class="nav-link" id="v-pills-Venmo-tab" data-toggle="pill" data-target="#v-pills-Venmo" type="button" role="tab" aria-controls="v-pills-Venmo" aria-selected="false">Venmo</button> -->

                                    <?php if (in_array('stripe', $invoiceDetails['invoice']['payment_methods'])): ?>
                                    {{--                                    <button class="stripe-payment-btn">--}}
                                    {{--                                        Pay with <span style="font-weight: 700;">Stripe</span>--}}
                                    {{--                                    </button>--}}
                                    <!-- <button class="nav-link" id="v-pills-stripe-tab" data-toggle="pill"
                                            data-target="#v-pills-stripe" type="button" role="tab"
                                            aria-controls="v-pills-stripe"
                                            aria-selected="false">Stripe
                                    </button> -->
                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-credit-card" role="tabpanel"
                                     aria-labelledby="v-pills-credit-card-tab">


                                    <!-- <div class="form-txt" id="form-txt-1">
                                        <h1>Card Details</h1>
                                        <p>your card details are shared securely via SSL for payment processing. <br>
                                            we do not store your card details on our server.</p>
                                    </div> -->

                                    <form id="paymentForm" method="post" action="{{ route('api.authorize.process-payment') }}">
                                        <!-- Card Number -->
                                        <div class="form-group">
                                            <label for="card_number">Card number</label>
                                            <input type="text" class="form-control" id="card_number" name="card_number" placeholder="1234 1234 1234 1234" maxlength="19" autocomplete="false">
                                            <span id="card_type_logo" class="cctype"></span>
                                            <small id="card_number_error" class="text-danger"></small>
                                        </div>

                                        <!-- CVV and Expiry -->
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="cvv">CVV</label>
                                                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="CVC" autocomplete="false">
                                                <small id="cvv_error" class="text-danger"></small>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="expiry">Expires on</label>
                                                <input type="text" class="form-control" id="expiry" name="expiry" placeholder="MM/YY" autocomplete="false">
                                                <small id="expiry_error" class="text-danger"></small>
                                            </div>
                                        </div>

                                        <!-- First Name and Last Name -->
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="first_name">First Name</label>
                                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="" autocomplete="false">
                                                <small id="first_name_error" class="text-danger"></small>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="" autocomplete="false">
                                                <small id="last_name_error" class="text-danger"></small>
                                            </div>
                                        </div>

                                        <!-- Email and Phone -->
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="" autocomplete="false">
                                                <small id="email_error" class="text-danger"></small>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="phone">Phone Number</label>
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="" autocomplete="false">
                                                <small id="phone_error" class="text-danger"></small>
                                            </div>
                                        </div>

                                        <!-- Billing Address -->
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <select id="country" class="form-control" autocomplete="false">
                                                <?php foreach ($countries as $code => $country): ?>
                                                <option value="<?= htmlspecialchars($code) ?>"><?= htmlspecialchars($country) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small id="country_error" class="text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="" autocomplete="false">
                                            <small id="address_error" class="text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" id="city" name="city" placeholder="" autocomplete="false">
                                            <small id="city_error" class="text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="zip">Postal/Zip Code</label>
                                            <input type="text" class="form-control" id="zip" name="zip" placeholder="" autocomplete="false">
                                            <small id="zip_error" class="text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control" id="state" name="state" placeholder="" autocomplete="false">
                                            <small id="state_error" class="text-danger"></small>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="payment-btn-wrapper">
                                            <button type="submit" class="btn btn-primary make-payment-btn">Make payment</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade " id="v-pills-paypal" role="tabpanel"
                                     aria-labelledby="v-pills-paypal-tab">Paypal..

                                    <div class="sec-btn">
                                        <a href=""></a>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-stripe" role="tabpanel"
                                     aria-labelledby="v-pills-stripe-tab">Stripe..
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="thanks">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <!--                <h5>Lorem ipsum dolor sit <br> amet consectetur adipisicing elit.-->
                <!--                </h5>-->
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

<script>
    // download file

    function generatePDF() {
        const element = document.getElementById('invoice');
        html2pdf()
            .from(element)
            .save();

    }
    // print file

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

    }

</script>
<script src="{{asset('assets/js/checkout.js')}}"></script>
</body>

</html>
