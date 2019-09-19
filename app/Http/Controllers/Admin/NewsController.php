<?php


namespace App\Http\Controllers\Admin;

use Auth;
use DB;
use Input;
use Carbon\Carbon;
use Redirect;
use App\News;
use App\NewsContent;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Language;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Requests\NewsFormRequest;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * View all posts
     *
     * @return mixed
     */
    public function indexNews()
    {

        return view('admin.news.index');

    }

    public function storeNews(NewsFormRequest $request)
    {
        $cms = new News();
        $cms->page_slug = $request->input('page_slug');
        $cms->seo_title = $request->input('seo_title');
        $cms->seo_description = $request->input('seo_description');
        $cms->seo_keywords = $request->input('seo_keywords');
        $cms->seo_other = $request->input('seo_other');
        $cms->show_in_top_menu = $request->input('show_in_top_menu');
        $cms->show_in_footer_menu = $request->input('show_in_footer_menu');
        $cms->save();
        flash('NEWS page has been added!')->success();
        return \Redirect::route('list.news');
    }

    public function editNews($id)
    {
        $news = Cms::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    public function createNews()
    {
        return view('admin.news.add');
    }

    public function fetchNewsData(Request $request)
    {
        $news = News::select(
            [
                'news.id',
                'news.page_slug',
                'news.seo_title',
                'news.seo_description',
                'news.seo_keywords',
                'news.seo_other',
                'news.created_at',
                'news.updated_at'
            ]
        );
        return Datatables::of($news)
            ->filter(function ($query) use ($request) {
                if ($request->has('id') && !empty($request->id)) {
                    $query->where('news.id', 'like', "{$request->get('id')}");
                }
                if ($request->has('page_slug') && !empty($request->page_slug)) {
                    $query->where('news.page_slug', 'like', "%{$request->get('page_slug')}%");
                }
            })
            ->addColumn('action', function ($news) {
                /*                             * ************************* */
                return '
				<div class="btn-group">
					<button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit.cms', ['id' => $news->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>						
						<li>
							<a href="javascript:void(0);" onclick="delete_cms(' . $news->id . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
						</li>																																							
					</ul>
				</div>';
            })
            ->rawColumns(['action'])
            ->setRowId(function($news) {
                return 'cms_dt_row_' . $news->id;
            })
            ->make(true);
    }
}