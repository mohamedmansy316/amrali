<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//use App\Http\Models\Book;
use App\Models\Book;
use App\Helper\helper;
//use Facade\FlareClient\Stacktrace\File;
//use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\renderSection;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $books = Book::get();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // for book photo
        $file_extension = $request->photo->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = 'upload_books';
        $request->photo->move($path, $file_name);
        //for book pdf
        $file_extension1 = $request->book_pdf->getClientOriginalExtension();
        $file_name1 = time() . '.' . $file_extension1;
        $path1 = 'upload_books';
        $request->book_pdf->move($path1, $file_name1);
        Book::create([
            'picture' => $file_name,
            'book_pdf' => $file_name1,
            'name' => $request->name,
            'pdf'=>$request->price_pdf,
            'inside_Egypt'=>$request->price_inside,
            'outside_Egypt'=>$request->price_outside,
        ]);
        return redirect()->back()->with('book', 'Book Saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book=Book::find($id);
        return view('books.edit',compact('book'));
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

        $update=array();
         $request->name==null? '' : $update['name'] = $request->name ;
        $request->price_pdf==null ? '' : $update['pdf'] =$request->price_pdf;
        $request->price_inside==null ? '':$update['inside_Egypt'] =$request->price_inside;
        $request->price_outside==null ? '': $update['outside_Egypt'] =$request->price_outside;
        Book::where('id', $id)->update($update);
        return redirect()->back()->with('book_edited', 'Book edited Successfully !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $book = Book::find($id);
        $img_destination = 'upload_books/' . $book->picture;
        $book_destination = 'upload_books/' . $book->book_pdf;
        if (File::exists($img_destination)) {
            File::delete($img_destination);
        }

        if (File::exists($book_destination)) {
            File::delete($book_destination);
        }
        $book->delete();
        return redirect()->back();
    }
    public function allbooks()
    {
        $books = Book::get();
        return view('books.userBooks', compact('books'));
    }
    //for download book
    public function download($id){
        $book= Book::findOrFail($id);
         $filepath = public_path('upload_books/'.$book->book_pdf);
         return Response()->download($filepath);
    }
    //for videos page
    public function videos(){
        return view('videos');
    }

   }
