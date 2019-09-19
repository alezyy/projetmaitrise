<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewsFormRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = (int) $this->input('id', 0);
        $id_str = '';
        if ($id > 0) {
            $id_str = ',' . $id;
        }
        return [
            'page_slug' => 'required|alpha_dash|unique:news,page_slug' . $id_str,
            'seo_title' => 'required',
            'seo_description' => 'required',
            'seo_keywords' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'page_slug.required' => 'Please enter page slug.',
            'page_slug.alpha_dash' => 'The page slug may have alpha-numeric characters, as well as dashes and underscores.',
            'page_slug.unique' => 'Some other NEWS page already has this Slug (Page SlUG should be unique).',
            'seo_title.required' => 'Please enter SEO title.',
            'seo_description.required' => 'Please enter SEO description.',
            'seo_keywords.required' => 'Please enter SEO keywords.',
        ];
    }

}
