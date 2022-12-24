<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use App\Models\Event;
use Mail;
use App\Mail\InvoiceEmailManager;
use App\Mail\EventEmail;
use App\Models\BookedEvent;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use Redirect;
use Auth;
use Session;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $events = Event::orderBy('created_at', 'desc');
        
        if ($request->search != null){
            $events = $events->where('title', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        $events = $events->paginate(15);

        return view('backend.event_system.event.index', compact('events','sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event_categories = EventCategory::all();
        return view('backend.event_system.event.create', compact('event_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|max:255',
        ]);

        $event = new Event;
        
        $event->category_id = $request->category_id;
        $event->title = $request->title;
        $event->banner = $request->banner;
        $event->price = $request->price;
        $event->event_date = $request->event_date;
        $event->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        $event->short_description = $request->short_description;
        $event->description = $request->description;
        
        $event->meta_title = $request->meta_title;
        $event->meta_img = $request->meta_img;
        $event->meta_description = $request->meta_description;
        $event->meta_keywords = $request->meta_keywords;
        
        $event->save();

        flash(translate('event post has been created successfully'))->success();
        return redirect()->route('event.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $event_categories = EventCategory::all();
        
        return view('backend.event_system.event.edit', compact('event','event_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|max:255',
        ]);

        $event = Event::find($id);

        $event->category_id = $request->category_id;
        $event->title = $request->title;
        $event->banner = $request->banner;
        $event->price = $request->price;
        $event->event_date = $request->event_date;
        $event->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        $event->short_description = $request->short_description;
        $event->description = $request->description;
        
        $event->meta_title = $request->meta_title;
        $event->meta_img = $request->meta_img;
        $event->meta_description = $request->meta_description;
        $event->meta_keywords = $request->meta_keywords;
        
        $event->save();

        flash(translate('event  has been updated successfully'))->success();
        return redirect()->route('event.index');
    }
    
    public function change_status(Request $request) {
        $event = Event::find($request->id);
        $event->status = $request->status;
        
        $event->save();
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::find($id)->delete();
        
        return redirect('admin/Events');
    }


    public function all_event() {
        $events = Event::where('status', 1)->orderBy('created_at', 'desc')->paginate(12);
        return view("frontend.events.events", compact('events'));
    }
    public function event_booking($id) {
        $events = Event::where('id',$id)->where('status', 1)->orderBy('created_at', 'desc')->get();
        return view("frontend.events.book", compact('events','id'));
    }
    
    
    public function event_details($slug) {
        $event = Event::where('slug', $slug)->first();
        return view("frontend.events.details", compact('event'));
    }
     public function processTransaction(Request $request)
    {   
         $price=$request->price;
         $event_id=$request->event_id;
         $data=Session::put('user_data', $request->all());
         $clientId = 'AbXhlldTae6iK3MZANHtzGBXGbCpw8B8SwGJXD5NiHQgT7_YhNvqM5NRgo2xGzMt-yZ-g_iTFoJrViXU';
         $clientSecret ='EOVLl_-UmU61dY8IpT78z80bM9m9HIVEmFTRyST7hUbwbUx920x-7APIZjZI78-gODXT469ERW_v7qQ_';
         $environment = new SandboxEnvironment($clientId, $clientSecret);
         $client = new PayPalHttpClient($environment);
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
                             "intent" => "CAPTURE",
                             "purchase_units" => [[
                                 "reference_id" => rand(000000,999999),
                                 "amount" => [
                                     "value" => $price,
                                     "currency_code" => "USD"
                                 ]
                             ]],
                             "application_context" => [
                                "return_url" => route('successTransaction'),
                                "cancel_url" => url('/cancelTransaction?id='.$event_id),
                             ]
                         ];
        
              try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            return Redirect::to($response->result->links[1]->href);
        }catch (\Exception $ex) {
            flash(translate('Something was wrong'))->error();
            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong.');
        }
    }
       public function successTransaction(Request $request)
    {

        
         $clientId = 'AbXhlldTae6iK3MZANHtzGBXGbCpw8B8SwGJXD5NiHQgT7_YhNvqM5NRgo2xGzMt-yZ-g_iTFoJrViXU';
         $clientSecret ='EOVLl_-UmU61dY8IpT78z80bM9m9HIVEmFTRyST7hUbwbUx920x-7APIZjZI78-gODXT469ERW_v7qQ_';
         $environment = new SandboxEnvironment($clientId, $clientSecret);
         $client = new PayPalHttpClient($environment);
         $ordersCaptureRequest = new OrdersCaptureRequest($request->token);
         $ordersCaptureRequest->prefer('return=representation');
         
        //   try {
            $response = $client->execute($ordersCaptureRequest);
             $result=$response->result;
            
            $data=Session::get('user_data');
            if($result->status=="COMPLETED"){
            $event = new BookedEvent;
            $event->user_id = Auth::id();
            $event->user_name = Auth::user()->name;
            $event->event_id = $data['event_id'];
            $event->event_name = $data['event_name'];
            $event->payment_status = 'Paid';
            $event->discard_id = $data['discard_id'];
            $event->game_id = $data['game_id'];
            $event->user_email = $data['email'];
            $event->msg = $data['msg'];
            $event->price = $data['price'];
            $event->status = 'Booked';
            $event->save();
            
                  
            $data=Session::get('user_data');
            
                $array['view'] = 'emails.event';
                $array['subject'] = translate('You are Informed that Event has been booked');
                $array['from'] = env('MAIL_FROM_ADDRESS');
                $array['event_id']= $data['event_id'];
                // try {
                    Mail::to(env('MAIL_FROM_ADDRESS'),$data['email'])->queue(new EventEmail($array));
                // } catch (\Exception $e) {

                // }
            
            
            
            return redirect()->to('bookevent/'.$data['event_id'])->with('message','Payment has been done and event is booked');
            }else{
            return redirect()->to('bookevent/'.$data['event_id'])->with('error','Something went wrong.');
            }
            
        //   }
        //   catch (\Exception $ex) {
        //     return redirect()->to('bookevent/'.$data['event_id'])->with('error','Something went wrong.');
        // }
    
    }
        public function cancelTransaction(Request $request)
    {
        return redirect()->to('bookevent/'.$request->id)->with('error', 'You have canceled the transaction.');
    }
    
    public function bookedevent(Request $request) {
        
        $sort_search = null;
        $events = BookedEvent::orderBy('created_at', 'desc');
        
        if ($request->search != null){
            $events = $events->where('event_name', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }
        
        $events = $events->paginate(15);
        return view("backend.event_system.bookedevent.index", compact('events'));
    }
    
}
