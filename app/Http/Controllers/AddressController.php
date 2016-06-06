<?php namespace App\Http\Controllers;


use App\Address;
use App\Electorate;
use Illuminate\Http\Request;
use App\Inroll\Repositories\AddressRepository;
use App\Pagination;
use Illuminate\Support\Facades\DB;


class AddressController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /addresses
	 * 
	 * @return Response
	 */
    protected $address;
    protected $electorate_lists;
    public function __construct(AddressRepository $address)
    {
        $this->middleware('auth');
        $this->address = $address;
        $this->electorate_lists = Electorate::lists('electorate', 'id');
    }

	public function index(Request $request)
	{
        if($street =$request->get('street')){
            $addresses = $this->getAddresses($request);
            $query = Address::where('street', $street);
            if ($request->get('electorate') || $request->get('house'))   {
                $electorate_group = collect([$addresses->first()]);
            }
            else{
                $electorate_group = $query->distinct()->get(array('electorate_id'));
            }

            return View('address.list', compact('addresses'))->with('electorates',$this->electorate_lists)->with('electorate_group',$electorate_group);
        }

        return View('address.index')->with('electorates',$this->electorate_lists);
	}

    public function getAddresses($request)
    {
        $addresses = $this->address->getAddress($request)->paginate(15);
        return $addresses;
    }

	public function show(Address $address)
	{
        return view('address.show', compact('address'));
	}

    public function findGap(){
        $addresses = DB::table('electors')->select('house_no','suburb_town', 'street')->distinct()->where('electorate_id', 12)->orderby ('street', 'house_no' )->get();
//        $grouped = [];
//        foreach($addresses as $key => $value){
//            $grouped[$value['street'].", ".$value['suburb_town']][] = $value['house_no'];
//        }

//        foreach (range(0,10) as $number){
//            echo $number."</br>";
//        }

        $info = array('coffee', 'brown', 'caffeine');
        // list() doesn't work with strings
        list($drink, , $power) = $info;
        echo "$drink has $power.\n";

        //array_flip(): Can only flip STRING and INTEGER values!
        $input = array("oranges", "apples", "pears");
        $flipped = array_flip($input);

        print_r($flipped);

//        foreach($grouped as $key => $value){
//            $range = range(min($value), max($value));
//            foreach ($range as $item){
//                    if(!in_array($item, $value)){
//                        echo($item ." ". $key."<br>");
//                    }
//            }
//        }
    }
}