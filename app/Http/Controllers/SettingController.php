<?php

namespace App\Http\Controllers;

use App\Models\UOM;
use App\Models\User;
use App\Models\Items;
use App\Models\Module;
use App\Models\InvRole;
use App\Models\Invshop;
use App\Models\Setting;
use App\Models\Products;
use App\Models\SysModule;
use App\Models\ExpenseCate;
use App\Models\InvLocation;
use App\Models\IngredientRe;
use App\Models\ProductGroup;
use Illuminate\Http\Request;
use App\Models\IngredientQty;
use App\Models\IteamCategory;
use App\Models\invProductCate;
use App\Models\ProductIngredients;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemCate = IteamCategory::all();
        $productCate = invProductCate::all();
        $user = User::all();
        $uom = UOM::all();
        $item = Items::all();
        $productIngredients = ProductIngredients::paginate(12);
        $invProduct = Products::paginate(12);
        $shop = Invshop::paginate(2);
        $shop_se =Invshop::all();
        $role = InvRole::all();
        $module = SysModule::all();
        $moduleInf = Module::all();
        $location = InvLocation::all();
        $group = ProductGroup::all();
        $expense = ExpenseCate::all();
        $ingredientQty = IngredientQty::all();
        return view('setting', compact('item','itemCate','productCate','user','invProduct','shop','role','module','moduleInf','uom','shop_se','location','group','expense','productIngredients','ingredientQty')); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop = Auth::user()->invShop->O_id;
        // Validate the input data
        $validatedData = $request->validate([
            'S_name' => ['required', 'string', 'max:255'],
            'S_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the file upload if a logo is provided
        $logoPath = null;
        if ($request->hasFile('S_logo') && $request->file('S_logo')->isValid()) {
            $logo = $request->file('S_logo');
            $logoPath = $logo->store('logos', 'public'); // Store under 'public/storage/logos'
        }
        // Create the shop record in the database
      
        Invshop::create([
            'S_name' => $validatedData['S_name'],
            'O_id' => $shop, // Assuming this is intentionally left empty
            'S_logo' => $logoPath,
        ]);
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'Shop created successfully!');
    }
    public function location(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'L_address' => ['required', 'string', 'max:255'],
            'S_id' => 'required|integer',
        ]);
    
        // Create the location record in the database
        InvLocation::create([
            'L_address' => $validatedData['L_address'],
            'L_name' => '', // Assuming this is optional or default
            'L_contact' => '', // Assuming this is optional or default
            'S_id' => $validatedData['S_id'], // Removed extra '$'
        ]);
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'Location created successfully!');
    }
    public function user(Request $request) {
        $data = $request->validate([
            'U_name' => ['required', 'string', 'max:255'],
            'sys_name' => ['required', 'string', 'max:255'],
            'U_contact' => ['required', 'string', 'max:255'],
            'R_id' => 'required|integer',
            'S_id' => 'required|integer',
            'L_id' => 'required|integer',
            'password' => ['required', 'string', 'min:8'], 
            'U_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        // Handle the file upload
        $photoPath = null;
        if ($request->hasFile('U_photo')) {
            $photo = $request->file('U_photo');
            if ($photo->isValid()) {
                $photoPath = $photo->store('user_photos', 'public');
            }
        }
    
        // Create the user
        User::create([
            'U_name' => $data['U_name'],
            'R_id' => $data['R_id'],
            'U_contact' => $data['U_contact'],
            'sys_name' => $data['sys_name'],
            'password' => Hash::make($data['password']), // Hash and save the password
            'S_id' => $data['S_id'],
            'L_id' => $data['L_id'],
            'U_photo' => $photoPath,
            'status' => 'active', // Set the status as needed
        ]);
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'User created successfully!');
    }
    
    
    public function category(Request $request){
        // Validate the input data
        $validatedData = $request->validate([
            'Item_Cate_Khname' => ['required', 'string', 'max:255'],
            'Item_Cate_Engname' => ['nullable', 'string', 'max:255'], // Add validation rule for English name
        ]);
    
        // Create the item category record in the database
        IteamCategory::create([
            'Item_Cate_Khname' => $validatedData['Item_Cate_Khname'],
            'Item_Cate_Engname' => $request->input('Item_Cate_Engname'), // Use request input directly
            'item_Cate_type' => '',
            'status' => 'Active',
        ]);
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'Category created successfully!');
    }
    
    public function product_cate(Request $request){
        $validatedData = $request->validate([
            'Cate_Khname' => ['required', 'string', 'max:255'],
            'Cate_Engname' => ['required', 'string', 'max:255'], // Add validation rule for English name
            'IPG_id' => 'required|integer',
        ]);
        
        // Create the item category record in the database
        invProductCate::create([
            'Cate_Khname' => $validatedData['Cate_Khname'],
            'Cate_Engname' =>  $validatedData['Cate_Engname'], // Use request input directly
            'IPG_id' => $validatedData['IPG_id'],
            'status' => 'Active',
        ]);
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'Category created successfully!');
    }
    public function expense_cate(Request $request){
        $validatedData = $request->validate([
            'IEC_Khname' => ['required', 'string', 'max:255'],
            'IEC_Engname' => ['required', 'string', 'max:255'], // Add validation rule for English name
      
        ]);
        
        // Create the item category record in the database
        ExpenseCate::create([
            'IEC_Khname' => $validatedData['IEC_Khname'],
            'IEC_Engname' =>  $validatedData['IEC_Engname'], // Use request input directly
            'status' => 'Active',
        ]);
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'Category created successfully!');
    }
    public function uom(Request $request){
        $validatedData = $request->validate([
            'UOM_name' => ['required', 'string', 'max:255'],
            'UOM_abb' => ['required', 'string', 'max:255'], // Add validation rule for English name
      
        ]);
        
        // Create the item category record in the database
        UOM::create([
            'UOM_name' => $validatedData['UOM_name'],
            'UOM_abb' =>  $validatedData['UOM_abb'], // Use request input directly
            'status' => 'Active',
        ]);
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'Category created successfully!');
    }
    // public function updateIngredients(Request $request, $Pro_id)
    // {
    
    //     // Validate the input data
    //     $validatedData = $request->validate([
    //         'IIQ_name' => 'required|integer',
    //     ]);

    //     // IngredientRe::where('Pro_id', $Pro_id)
    //     //     ->update(['IIQ_name' => $validatedData['IIQ_name']]);
    
    //     // Redirect or return a response
    //     return redirect()->back()->with('success', 'Product(s) updated successfully!');
    // }
    public function updateIngredients(Request $request, $IPI_id)
{

    // Validate the input data
    $validatedData = $request->validate([
        'IIQ_id' => 'required|integer',
    ]);

    // Find the product by its ID
 
    $product = IngredientRe::where('IPI_id', $IPI_id)->firstOrFail();
    // Check if the product exists
    if (!$product) {
        return redirect()->back()->with('error', 'Product not found.');
    }

    // Update the product's IIQ_id field
    $product->IIQ_id = $validatedData['IIQ_id'];
    $product->save();

    // Redirect or return a response

    // Redirect or return a response
    return redirect()->back()->with('success', 'Product updated successfully!');
}

    
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $S_id)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'S_name' => 'required|string|max:255',
            'S_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $shop = Invshop::findOrFail($S_id);
        $shop->S_name = $validatedData['S_name'];
        if ($request->hasFile('S_logo') && $request->file('S_logo')->isValid()) {
            // Delete the old image if it exists
            if ($shop->S_logo && Storage::disk('public')->exists($shop->S_logo)) {
                Storage::disk('public')->delete($shop->S_logo);
            }  
            $s_logo = $request->file('S_logo');
            $imagePath = $s_logo->store('logos', 'public');
            $shop->S_logo = $imagePath;
        }    
        // Save the updated shop record
        $shop->save();
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'Shop updated successfully!');
    } 
    public function updateUser(Request $request, $U_id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'U_name' => 'required|string|max:255',
            'U_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'R_id' => 'required|integer',
            'sys_name' => 'required|string|max:255',
            'U_contact' => 'required|string|max:255',
            'password' => ['required', 'string', 'min:8'],
            'newpassword' => 'nullable|string|min:8', 
        ]);
    
        // Find the user record by ID
        $user = User::findOrFail($U_id);
        
     
        // Update user details
        $user->U_name = $validatedData['U_name'];
        $user->R_id = $validatedData['R_id'];
        $user->sys_name = $validatedData['sys_name'];
        $user->U_contact = $validatedData['U_contact'];
    
        // Handle password update
        if ($request->filled('newpassword')) {
            $user->password = bcrypt($request->input('newpassword'));
        }
    
        // Handle the image upload if a new image is provided
        if ($request->hasFile('U_photo') && $request->file('U_photo')->isValid()) {
            // Delete the old image if it exists
            if ($user->U_photo && Storage::disk('public')->exists($user->U_photo)) {
                Storage::disk('public')->delete($user->U_photo);
            }
    
            // Store the new image and update the U_photo field
            $photo = $request->file('U_photo');
            $imagePath = $photo->store('profile_pics', 'public');
            $user->U_photo = $imagePath;
        }
    
        // Save the updated user record
        $user->save();
    
        // Redirect or return a response
        return redirect()->back()->with('success', 'User updated successfully!');
    }
    
    public function createIng(Request $request){

        $validatedData = $request->validate([
            'Qty' => 'required|integer',
            'Item_id' => 'required|integer',
            'UOM_id' =>'required|integer',
            'IIQ_name' => ['required', 'string', 'max:255'],
      
        ]);        
        // Create the item category record in the database
        IngredientQty::create([
            'Qty' => $validatedData['Qty'],
            'Item_id' =>  $validatedData['Item_id'], 
            'UOM_id' => $validatedData['UOM_id'],
            'IIQ_name' =>  $validatedData['IIQ_name'], 
            'status' => 'Active',
        ]);   
        // Redirect or return a response
        return redirect()->back()->with('success', 'Category created successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }

}
