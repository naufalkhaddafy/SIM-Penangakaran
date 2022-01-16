<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Kandang;
use App\Models\Category;
use App\Models\Produksi;
use App\Models\Penangkaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->Penangkaran = new Penangkaran();
        $this->User = new User();
        $this->Category = new Category();
        $this->Kandang = new Kandang();
        $this->middleware('auth');
    }
    //halaman dashboard
    public function readdashboard()
    {
        $data=[
            'users' => User::all(),
            'penangkarans' => Penangkaran::all(),
            'kandangs' =>Kandang::all(),
        ];

        return view('dashboard', $data);
    }
    //view pengguna
    public function readuser()
    {
        $data = [
            'users' => User::all(),
            'penangkarans' => Penangkaran::all(),
            'kandangs' => Kandang::all(),
        ];
        return view('pengguna.pengguna',$data);
    }
    // nambah user
    public function createuser(Request $request)
    {
        $validateuser= $request->validate([
            'namalengkap' =>'required',
            'username' =>'required|unique:users',
            //'nohp' =>'unique:users|min:12|max:14',
            'nohp' =>'unique:users',
            'password' =>'required|min:5',
            'level' =>'required',
            'penangkaran_id' =>'required',
        ],[
            'namalengkap.required' => 'Nama Harus di Isi',
            'username.required' => 'Username Harus di Isi',
            'username.unique' => 'Username telah terdaftar',
            //'nohp.required' => 'No. Hp Harus di Isi',
            'nohp.unique' => 'No. Hp telah terdaftar',
            //'nohp.min' => 'Masukan No. Hp yang sesuai',
            //'nohp.max' => 'Masukan No. Hp yang sesuai',
            'password.required' =>'Password harus di Isi',
            'password.min' =>'Password minimal 5 Digit',
            'penangkaran_id.required' =>'Harus diisi',
        ]);
        // if($validateuser->fails()) {

        //     return response()->json([
        //         'status'=> 400,
        //         'errors' =>$validateuser->messages(),
        //     ]);
        // }else{
        //     // $validateuser['password']=Hash::make($validateuser['password']);

        //     // User::create($validateuser);
        //     // $this->User = $this->input('namalengkap');
        //     // $this->User = $this->input('username');
        //     // $this->User = $this->input('nohp');
        //     // $this->User = $this->input('password');
        //     // $this->User = $this->input('penangkaran_id');
        //     // $this->User = $this->input('level');
        //     // $this->User->save();
        //     return response()->json([
        //         'status'=> 200,
        //     ])->with('create','Berhasil menambahkan pengguna');
        // }
        $validateuser['password']=Hash::make($validateuser['password']);
        User::create($validateuser);
        return redirect('pengguna')->with('create','Berhasil menambahkan pengguna');
    }
    // hapus pengguna
    public function deletepengguna($id)
    {
        User::find($id)->delete();
        return redirect()->route('pengguna')->with('delete', 'Data Berhasil di hapus');
    }
    //update
    public function updateuser($id){

        $validateuser= Request()->validate([
            'namalengkap' =>'required',
            'username' =>'required',
            'level' =>'required',
            'penangkaran_id' =>'nullable',
            'nohp'=>'nullable',
        ],[
            'namalengkap.required' => 'Nama Harus di Isi',
            'username.required' => 'Username Harus di Isi',
            //'penangkaran_id.required' =>'Harus diisi',
        ]);
        User::find($id)->update($validateuser);
        return redirect()->back()->with('update','Data Berhasil di update');
    }
    // viewpenangkaran
    public function readpenangkaran()
    {
        $data = [
            'penangkarans' =>Penangkaran::all(),
        ];
        $cek=Penangkaran::count();
        if($cek==null){
            $urut= 1;
            $kode='PNK-0'. $urut;
        }else{
            $ambil=Penangkaran::all()->last();
            $urut=(int)substr($ambil->kode_penangkaran,-1) + 1;
            $kode='PNK-0'. $urut;
        }

        return view('penangkaran', $data,compact('kode'));
    }
    // create penangkaran
    public function createpenangkaran()
    {
        $validatelokasi = Request()->validate([
            'kode_penangkaran' =>'required|unique:penangkarans',
            'lokasi_penangkaran' =>'required|unique:penangkarans',

        ],[
            'kode_penangkaran.required' => 'kode Harus di Isi',
            'kode_penangkaran.unique' => 'Kode sudah ada',
            'lokasi_penangkaran.required' => 'Lokasi Harus di Isi',
            'lokasi_penangkaran.unique' => 'Lokasi telah ada',
        ]);
        $this->Penangkaran->insert($validatelokasi);

        return redirect()->route('penangkaran')->with('create', 'Berhasil Menambahkan');
    }
    public function detailkandang($id)
    {
        if (!Penangkaran::find($id)) {
            abort(404);
        }
        $data = [
            'penangkarans' => Penangkaran::find($id),
            'categories' => Category::all(),
        ];
        //$kode = Penangkaran::get('kode_penangkaran');
        return view('readkandang', $data);
    }
    // detail penangkaran
    public function detailpenangkaran($id)
    {
        if (!Penangkaran::find($id)) {
            abort(404);
        }
        $data = [
            'penangkarans' => Penangkaran::find($id),
            'categories' => Category::all(),
        ];
        //$kode = Penangkaran::get('kode_penangkaran');
        return view('detailkandang', $data);
    }
    // delete penangkaran
    public function deletepenangkaran($id)
    {
        if (!Penangkaran::find($id)) {
            abort(404);
        }
        if(Penangkaran::find($id)->delete())
        {
            $this->Kandang->where('penangkaran_id', $id)->delete();
        }

        return redirect()->route('penangkaran')->with('delete', 'Data Berhasil di hapus');
    }
    // kategori produksi
    public function readkategoriproduksi()
    {
        $data = [

            'categories' =>Category::all(),
        ];
        return view('kategoriproduksi',$data);
    }
    //view kategori
    public function readkategori()
    {
        $data = [
            'categories' =>Category::all(),
        ];
        $cek=Category::count();
        if($cek==null){
            $urut= 1;
            $kode='KTG-0'. $urut;
        }else{
            $ambil=Category::all()->last();
            $urut=(int)substr($ambil->kode_kategori,-1) + 1;
            $kode='KTG-0'. $urut;
        }
        return view('category',$data,compact('kode'));
    }
    //create kategori
    public function createkategori()
    {
        $validatekategori = Request()->validate([
            'kode_kategori' =>'required|unique:categories',
            'kategori' =>'required|unique:categories',

        ],[
            'kode_kategori.required' => 'kode Harus di Isi',
            'kode_kategori.unique' => 'Kode sudah ada',
            'kategori.required' => 'Kategori Harus di Isi',
            'kategori.unique' => 'Kategori telah ada',
        ]);

        $this->Category->insert($validatekategori);
        return redirect()->route('kategori')->with('create', 'Berhasil Menambahkan');
    }
    //delete kategori
    public function deletekategori($id)
    {
        Category::find($id)->delete();
        return redirect()->route('kategori')->with('delete', 'Kategori Berhasil di hapus');
    }
    //view kandang
    public function readkandang()
    {
        $data=([
            'kandangs'=> Kandang::all(),
            'categories' => Category::all(),
            'penangkarans' => Penangkaran::all(),
        ]);
        return view('kandang',$data);
    }

    //create kandang
    public function createkandang(){
        $validatekandang = Request()->validate([
            'namakandang' =>'required',
            'category_id' =>'required',
            'penangkaran_id' =>'required'
            // 'kategori' =>'required|unique:categories',

        ],[
            'namakandang.required' => 'kode Harus di Isi',
            //'namakandang.unique' => 'Kode sudah ada',

            // 'kategori.required' => 'Lokasi Harus di Isi',
            // 'kategori.unique' => 'Lokasi telah ada',
        ]);
        $this->Kandang->insert($validatekandang);
        //$this->Kandang->createkandang($validatekandang);
        return redirect()->back()->with('create', 'Berhasil Menambahkan');
    }

    public function deletekandang($id)
    {
        Kandang::find($id)->delete();
        return redirect()->back()->with('delete','Berhasil menghapus data kandang');
    }
    public function readreportproduksi(){
        $data=([
            'penangkarans' =>Penangkaran::all(),
            'produksis'=>Produksi::all(),
        ]);
        return view('produksi',$data);
    }
    public function readpakan(){
        return view('pakan');
    }
}
