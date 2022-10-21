<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Accounts;
use App\Models\Cards;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use \weepay\Model\CreatePaymentRequestThreeDInitialize;

class CreatePaymentController extends Controller
{

    public function index()
    {

        $accounts = Accounts::all();
        $cards = Cards::all();

        return view('CreatePayment.index')->with("page","createPayment")->with("accounts",$accounts)->with("cards",$cards);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'accountId' => 'required|not_in:0',
            'creditCardId' => 'required|not_in:0',
            'price' => 'required',
        ]);

        $order = Orders::create([
            'price' => $request->price,
            'creditCardId' => $request->creditCardId,
            'accountId' => $request->accountId,
            'status' =>0,
        ]);
        
        $account = Accounts::find($request->accountId);
        $card = Cards::find($request->creditCardId);
        $price = $request->price;
        $ip = $request->getClientIp();

        if(isset($request->threedSecure)){
           $createPaymentRequest =  $this->threeDPayment($account,$card,$price,$ip,$order);
           
           if ($createPaymentRequest->getStatus() == 'success') {
                $threeDUrl = $createPaymentRequest->getThreeDSecureUrl();
                return redirect()->to($threeDUrl)->send();
            } else {
                print_r($createPaymentRequest->getError());
                print_r($createPaymentRequest->getErrorCode());
                print_r($createPaymentRequest->getMessage());
            }

        }else{
            $createPaymentRequest = $this->nonThreeDPayment($account,$card,$price,$ip,$order);
            if ($createPaymentRequest->getStatus() == 'success') {
                $paymentId = $createPaymentRequest->getPaymentId();
                return $paymentId;
            } else {
                return redirect('/payment/error')->with('status',$createPaymentRequest->getMessage());
            }

        }
    }

    public function threeDPayment($account,$card,$price,$ip,$order)
    {
        $options = new \weepay\Auth();
        $options->setBayiID($account->dealerId);
        $options->setApiKey($account->apiKey);
        $options->setSecretKey($account->secretKey);
        $options->setBaseUrl("https://api.weepay.co/");
            
        //Request
        $request = new \weepay\Request\CreatePaymentRequestThreeD();
        $request->setOrderId($order->id);
        $request->setIpAddress($ip);
        $request->setPrice($price);
        $request->setCurrency(\weepay\Model\Currency::TL);
        $request->setLocale(\weepay\Model\Locale::TR);
        $request->setDescription('Elestaş Ödeme');
        $request->setCardHolderName($card->holderName);
        $request->setCardNumber($card->cardNumber);
        $request->setEpireMonth($card->expiryMonth);
        $request->setExpireYear($card->expiryYear);
        $request->setCvcNumber($card->cvc);

        $request->setCallBackUrl("http://localhost:8000/callback");
        $request->setInstallmentNumber(1);
        $request->setPaymentGroup(\weepay\Model\PaymentGroup::PRODUCT);
        $request->setPaymentChannel(\weepay\Model\PaymentChannel::WEB);

        //Customer
        $customer = new \weepay\Model\Customer();
        $customer->setCustomerId(1235); // Üye işyeri müşteri Id
        $customer->setCustomerName("isim"); //Üye işyeri müşteri ismi
        $customer->setCustomerSurname("soyisim"); //Üye işyeri müşteri Soyisim
        $customer->setGsmNumber("50XXXXXX"); //Üye işyeri müşteri Cep Tel
        $customer->setEmail("helo@weepay.co"); //Üye işyeri müşteri ismi
        $customer->setIdentityNumber(11111111111); //Üye işyeri müşteri TC numarası
        $customer->setCity("istanbul"); //Üye işyeri müşteri il
        $customer->setCountry("turkey"); //Üye işyeri müşteri ülke
        $request->setCustomer($customer);
        // Fatura Adresi
        $BillingAddress = new \weepay\Model\Address();
        $BillingAddress->setContactName("isim soyisim");
        $BillingAddress->setAddress("Abdurrahman Nafiz Gürman,Mh, G. Ali Rıza Gürcan Cd. No:27");
        $BillingAddress->setCity("istanbul");
        $BillingAddress->setCountry("turkey");
        $BillingAddress->setZipCode("34164");
        $request->setBillingAddress($BillingAddress);

        //Kargo / Teslimat Adresi
        $ShippingAddress = new \weepay\Model\Address();
        $ShippingAddress->setContactName("isim soyisim");
        $ShippingAddress->setAddress("Abdurrahman Nafiz Gürman,Mh, G. Ali Rıza Gürcan Cd. No:27");
        $ShippingAddress->setCity("istanbul");
        $ShippingAddress->setCountry("turkey");
        $ShippingAddress->setZipCode("34164");
        $request->setShippingAddress($ShippingAddress);


        // Sipariş Ürünleri
        $Products = array();
        $firstProducts = new \weepay\Model\Product();
        $firstProducts->setName("Borç Ödemesi");
        $firstProducts->setProductId(15);
        $firstProducts->setProductPrice($price);
        $firstProducts->setItemType(\weepay\Model\ProductType::PHYSICAL);
        $Products[0] = $firstProducts;

        $request->setProducts($Products);

        $createPaymentRequest = CreatePaymentRequestThreeDInitialize::create($request, $options);

        return $createPaymentRequest;
        
    }

    public function nonThreeDPayment($account,$card,$price,$ip,$order)
    {
        $options = new \weepay\Auth();
        $options->setBayiID($account->dealerId);
        $options->setApiKey($account->apiKey);
        $options->setSecretKey($account->secretKey);
        $options->setBaseUrl("https://api.weepay.co/");

        //Request
        $request = new \weepay\Request\CreatePaymentRequest();
        $request->setOrderId($order->id);
        $request->setIpAddress($ip);
        $request->setPrice($price);
        $request->setCurrency(\weepay\Model\Currency::TL);
        $request->setLocale(\weepay\Model\Locale::TR);
        $request->setDescription('Elestaş Ödeme');
        $request->setCardHolderName($card->holderName);
        $request->setCardNumber($card->cardNumber);
        $request->setEpireMonth($card->expiryMonth);
        $request->setExpireYear($card->expiryYear);
        $request->setCvcNumber($card->cvc);
        $request->setInstallmentNumber(1);
        $request->setPaymentGroup(\weepay\Model\PaymentGroup::PRODUCT);
        $request->setPaymentChannel(\weepay\Model\PaymentChannel::WEB);

        //Customer
        $customer = new \weepay\Model\Customer();
        $customer->setCustomerId(1235); // Üye işyeri müşteri Id
        $customer->setCustomerName("isim"); //Üye işyeri müşteri ismi
        $customer->setCustomerSurname("soyisim"); //Üye işyeri müşteri Soyisim
        $customer->setGsmNumber("50XXXXXX"); //Üye işyeri müşteri Cep Tel
        $customer->setEmail("helo@weepay.co"); //Üye işyeri müşteri ismi
        $customer->setIdentityNumber("00032222721"); //Üye işyeri müşteri TC numarası
        $customer->setCity("istanbul"); //Üye işyeri müşteri il
        $customer->setCountry("turkey"); //Üye işyeri müşteri ülke
        $request->setCustomer($customer);

        // Fatura Adresi
        $BillingAddress = new \weepay\Model\Address();
        $BillingAddress->setContactName("isim soyisim");
        $BillingAddress->setAddress("Abdurrahman Nafiz Gürman,Mh, G. Ali Rıza Gürcan Cd. No:27");
        $BillingAddress->setCity("istanbul");
        $BillingAddress->setCountry("turkey");
        $BillingAddress->setZipCode("34164");
        $request->setBillingAddress($BillingAddress);

        //Kargo / Teslimat Adresi
        $ShippingAddress = new \weepay\Model\Address();
        $ShippingAddress->setContactName("isim soyisim");
        $ShippingAddress->setAddress("Abdurrahman Nafiz Gürman,Mh, G. Ali Rıza Gürcan Cd. No:27");
        $ShippingAddress->setCity("istanbul");
        $ShippingAddress->setCountry("turkey");
        $ShippingAddress->setZipCode("34164");
        $request->setShippingAddress($ShippingAddress);
        // Sipariş Ürünleri
        
        $Products = array();

        // Birinci Ürün
        $firstProducts = new \weepay\Model\Product();
        $firstProducts->setName("Borç Ödemesi");
        $firstProducts->setProductId(15);
        $firstProducts->setProductPrice($price);
        $firstProducts->setItemType(\weepay\Model\ProductType::PHYSICAL);
        $Products[0] = $firstProducts;
        $request->setProducts($Products);

        $createPaymentRequest = \weepay\Model\CreatePaymentRequestInitialize::create($request, $options);

        return $createPaymentRequest;
    }
}