<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\model\Role;
use App\model\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class crudLecteurControler extends Controller
{
    
 public function index(Request $request)
        {
      
            if ($request->ajax()) {
                $data =User::latest()->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
       
                               $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"><i class="icon-edit"></i> Modifier</a>';
       
                               $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="icon-trash"></i> </i> Supprimer</a>';
        
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
          
            return view('admin.crud_lecteur',compact('products'));
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
                'first_name'      =>['required'],
                'last_name'       =>['required'],
                'email'           =>['email','required'],
                'telephone'       =>['required'],
                'date_naissance'  =>['required']
            ]);
            $userId = $request->product_id;
            $role_lecteur=Role::where('name', 'lecteur')->first();
            $user =User::updateOrCreate(['id' => $userId],
                        ['first_name'     =>request('first_name'),
                        'last_name'       =>request('last_name'),
                        'email'           =>request('email'), 
                        'telephone'       =>request('telephone'),
                        'date_naissance'  =>request('date_naissance'),
                        'password'        =>bcrypt("passer123")]);  
                        $user->roles()->attach($role_lecteur);      
                        return response()->json(['success'=>'Vous venez d\'enrigistrer un nouveau Lecteur']);
                       
        }
       
        public function edit($id)
        {
            $user = User::find($id);
            return response()->json($user);
        }
        
      
        public function destroy($id)
        {
            User::find($id)->delete();
         
            return response()->json(['success'=>'Product deleted successfully.']);
        }
    }

