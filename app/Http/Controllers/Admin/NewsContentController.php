<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DB;
use Input;
use File;
use ImgUploader;
use Carbon\Carbon;
use Redirect;
use App\News;
use App\NewsContent;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Language;
use App\Http\Requests;
use App\Traits\NewsTrait;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Requests\NewsContentFormRequest;
use App\Http\Controllers\Controller;

class NewsContentController extends Controller
{
    use NewsTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexNewsContent()
    {
        return view('admin.news_content.index');
    }

    public function createNewsContent()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        $newsPages = news::select('news.id', 'news.page_slug')->orderBy('news.page_slug')->pluck('news.page_slug', 'news.id')->toArray();
        return view('admin.news_content.add')
                        ->with('languages', $languages)
                        ->with('newsPages', $newsPages);
    }

    public function storeNewsContent(NewsContentFormRequest $request)
    {
        $newsContent = new NewsContent();

        /*         * **************************************** */
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $fileName = ImgUploader::UploadImage('news_images', $image, $request->input('page_title'), 300, 300, false);
            $newsContent->image_head = $fileName;
        }
        /*        * ************************************** */


        $newsContent->page_id = $request->input('page_id');
        $newsContent->page_title = $request->input('page_title');
        $newsContent->page_content = $request->input('page_content');
        $newsContent->lang = $request->input('lang');
        $newsContent->save();
        flash('NEWS page has been added!')->success();
        return \Redirect::route('edit.newsContent', array($newsContent->id));
    }

    public function editNewsContent($id)
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        $newsPages = news::select('news.id', 'news.page_slug')->orderBy('news.page_slug')->pluck('news.page_slug', 'news.id')->toArray();
        $newsContent = NewsContent::findOrFail($id);
        return view('admin.news_content.edit', compact('languages', 'newsPages', 'newsContent'));
    }

    public function updateNewsContent($id, NewsContentFormRequest $request)
    {
        $newsContent = NewsContent::findOrFail($id);

        /*         * **************************************** */
        if ($request->hasFile('logo')) {
            $is_deleted = $this->deleteNewsContentLogo($newsContent->id);
            $image = $request->file('logo');
            $fileName = ImgUploader::UploadImage('news_images', $image, $request->input('name'), 300, 300, false);
            $newsContent->image_head = $fileName;
        }
        /*         * ************************************** */


        $newsContent->page_id = $request->input('page_id');
        $newsContent->page_title = $request->input('page_title');
        $newsContent->page_content = $request->input('page_content');
        $newsContent->lang = $request->input('lang');
        $newsContent->update();
        flash('NEWS page has been updated!')->success();
        return \Redirect::route('edit.newsContent', array($newsContent->id));
    }

    public function deleteNewsContent(Request $request)
    {
        $id = $request->input('id');
        try {
            $newsContent = NewsContent::findOrFail($id);
            $newsContent->delete();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }



    public function fetchNewsContentData(Request $request)
    {
        $newsContent = NewsContent::select(
                        [
                            'news_content.id',
                            'news_content.page_title',
                            'news_content.page_id',
                            'news_content.page_content',
                            'news_content.lang',
                            'news_content.created_at',
                            'news_content.updated_at'
                        ]
        );
        return Datatables::of($newsContent)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('id') && !empty($request->id)) {
                                $query->where('news_content.id', 'like', "{$request->get('id')}");
                            }
                            if ($request->has('page_title') && !empty($request->page_title)) {
                                $query->where('news_content.page_title', 'like', "%{$request->get('page_title')}%");
                            }
                        })
                        ->addColumn('page_title', function ($newsContent) {
                            $page_title = str_limit($newsContent->page_title, 100, '...');
                            $direction = MiscHelper::getLangDirection($newsContent->lang);
                            return '<span dir="' . $direction . '">' . $page_title . '</span>';
                        })
                        ->addColumn('page_content', function ($newsContent) {
                            $page_content = str_limit($newsContent->page_content, 100, '...');
                            $direction = MiscHelper::getLangDirection($newsContent->lang);
                            return '<span dir="' . $direction . '">' . $page_content . '</span>';
                        })
                        ->addColumn('action', function ($newsContent) {
                            /*                             * ************************* */
                            return '
				<div class="btn-group">
					<button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit.newsContent', ['id' => $newsContent->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>						
						<li>
							<a href="javascript:void(0);" onclick="delete_newsContent(' . $newsContent->id . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
						</li>																																							
					</ul>
				</div>';
                        })
                        ->rawColumns(['page_title', 'page_content', 'action'])
                        ->setRowId(function($newsContent) {
                            return 'cmsContent_dt_row_' . $newsContent->id;
                        })
                        ->make(true);
    }

}
