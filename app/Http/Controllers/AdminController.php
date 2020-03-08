<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Article;
class AdminController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    //    $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $pageinfo = array();
        if (! $request->has("page") )
        $page = 1 ;
        else
        $page = $request->input("page") ;

        $page[] = $page;
        $pageinfo[] = ( new Article())->get()->count();
        $page*= 10 ;
                return view('home')
                ->with("articles",  (( new Article())->skip($page)->take(10)->get()))
                ->with("pageinfo");
                
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {/*  name', 'ShortDesc', 'desc'
        , 'price'
        , 'discountFromPrice'
        , 'currency'
        , 'tax'
        , 'were'
        , 'votes_like'
        , 'votes_unlike'
        , 'status'   , 'OnTopNumber'*/
        $validatedData =Validator::make ( $request->all() ,[
            'name' => 'required|max:255',
             'ShortDesc' => 'required|max:255',
             'desc' => 'required',
             'price' => 'required|numeric',
             'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
           ]);
           if ( $validatedData->passes() )
           {
              $article = new Article ();
              $article->name = $request->input("name");
              $article->ShortDesc = $request->input("ShortDesc");
              $article->desc = $request->input("desc");
              $article->price = $request->input("price");
           
              $imageName = time().'.'.request()->image->getClientOriginalExtension();
              request()->image->move(public_path('images'), $imageName);
              $article->image = $imageName;
               $ok =  $article->save();            
               return response()->json(["error" => !$ok, "data"=>["save" =>  $ok] ]);
           }
           else
           {
                   return response()->json(["error" => 1 , "data"=> $validatedData->errors()]);
           }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
           if ( is_numeric($id) ){
           
               return response()->json(["error" => 0, "data"=>["save" =>  0] ]);
           }
           else
           {
                   return response()->json(["error" => 1 , "data"=> ["id"=>"id most be number"]]);
           }

        //
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {           if ( is_numeric($id) ){
           
        return response()->json(["error" => 0, "data"=>["save" =>  0] ]);
    }
    else
    {
            return response()->json(["error" => 1 , "data"=> ["id"=>"id most be number"]]);
    }

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
        $request->input["id"] = $id;
        $validatedData =Validator::make ( $request->all() ,[
             'id' => 'required|max:9999999|numeric',
            // 'body' => 'required',
         ]);
         if ( $validatedData->passes() )
         {
            $data ="";
             return response()->json(["error" => 0 , "data"=> $data]);
         }
         else
         {
 
 
                 return response()->json(["error" => 1 , "data"=> $validatedData->errors()]);
 
 
         }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        if ( is_numeric($id) ){
           
        return response()->json(["error" => 0, "data"=>["save" =>  0] ]);
    }
    else
    {
            return response()->json(["error" => 1 , "data"=> ["id"=>"id most be number"]]);
    }

        //
    }




}
