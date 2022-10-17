<?php

namespace App\Http\Controllers;

use App\Interfaces\ContactRepositoryInterface;
use App\Interfaces\ScheduleRepositoryInterface;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\MasterMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeFrontEndController extends Controller
{
    private ContactRepositoryInterface $contactRepository;
    private ScheduleRepositoryInterface $scheduleRepository;

    public function __construct(ContactRepositoryInterface $contactRepository, ScheduleRepositoryInterface $scheduleRepository)
    {
        $this->contactRepository = $contactRepository;
        $this->scheduleRepository = $scheduleRepository;
    }

    public function index()
    {
        $category = Category::where('status', true)->get();
        $favorite = MasterMenu::where('is_favorite', true)->where('status', true)->get();
        $gallery = Gallery::where('status', true)->get();
        $blog = Blog::where('status', true)->orderBy('created_at', 'ASC')->take(3)->get();
        return view('dashboard_front_end', compact('favorite', 'category', 'gallery', 'blog'));
    }

    public function menu(Request $req)
    {
        $category = Category::where('status', true)->get();
        $menu = MasterMenu::where('status', true)
            ->where(function ($q) use ($req) {
                if (isset($req->category_id)) {
                    $q->where('category_id', $req->category_id);
                }
                if (isset($req->param)) {
                    $q->where(DB::raw("UPPER(name)"), 'like', '%' . strtoupper($req->param) . '%');
                }
            })
            ->where('status', true)
            ->orderBy('created_at', 'DESC')
            ->paginate()
            ->appends(request()->query());
        return view('front_end/menu', compact('menu', 'category'));
    }

    public function menuDetail($slug)
    {
        $menu = MasterMenu::where('slug', $slug)->first();
        return view('front_end/menu_detail', compact('menu'));
    }

    public function faq()
    {
        $faq = Faq::where('status', true)->orderBy('created_at', 'ASC')->get();
        return view('front_end/faq', compact('faq'));
    }

    public function contact()
    {
        return view('front_end/contact');
    }

    public function schedule()
    {
        $data = $this->scheduleRepository->getAllSchedules();
        return view('front_end/schedule', compact('data'));
    }

    public function contactStore(Request $req)
    {
        return DB::transaction(function () use ($req) {
            $validator = Validator::make(
                $req->all(),
                [
                    'email'       => 'email',
                ],
            );

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }
            Contact::create([
                'id'    => $this->contactRepository->getIdContact(),
                'name'  => $req->name,
                'email' => $req->email,
                'phone' => $req->phone,
                'subject'   => $req->subject,
                'message'   => $req->message,
            ]);

            Session::flash('message', 'Success submit form');
            return back();
        });
    }

    public function blog()
    {
        $blog = Blog::where('status', true)->orderBy('created_at', 'ASC')->paginate();
        return view('front_end/blog', compact('blog'));
    }

    public function blogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        $new = Blog::orderBy('created_at', 'DESC')->whereNot('id', $blog->id)->take(3)->get();
        return view('front_end/blog_detail', compact('blog', 'new'));
    }
}
