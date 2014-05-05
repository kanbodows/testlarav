<?php

class AdminVideosController extends AdminController {


    /**
     * Video Model
     * @var Video
     */
    protected $video;

    /**
     * Inject the models.
     * @param Video $video
     */
    public function __construct(Video $video)
    {
        parent::__construct();
        $this->video = $video;
    }
/**
     * Returns all the videos.
     *
     * @return View
     */
    public function getIndexModerated()
    {
            // Get all the videos
            $videos = $this->video->where('moderated', true)->orderBy('created_at', 'DESC')->paginate(8);

            // Show the page
            return View::make('site/video/index', compact('videos'));
    }
    /**
     * Show a list of all the video videos.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/videos/title.video_management');

        // Grab all the videos
        $videos = $this->video;

        // Show the page
        return View::make('admin/videos/index', compact('videos', 'title'));
    }
    
    /**
     * Show a list of all the video videos.
     *
     * @return View
     */
    public function getEditlist()
    {
        // Title
        $title = Lang::get('admin/videos/title.video_edit');

        // Grab all the videos
        $videos = $this->video;

        // Show the page
        return View::make('admin/videos/editlist', compact('videos', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('admin/videos/title.create_a_new_video');

        // Show the page
        return View::make('admin/videos/create_edit', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
        // Declare the rules for the form validation
        $rules = array(
           'user' => 'required|min:5',
            'link'   => 'required|min:10',
            'description' => 'required|min:10'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new video 
            $user = Auth::user();

            // Update the video data
            $this->video->link            = Input::get('link');
            $this->video->description     = Input::get('description');
            $this->video->user            = Input::get('user');

            // Was the video created?
            if($this->video->save())
            {
                // Redirect to the new video page
                return Redirect::to('admin/videos/' . $this->video->id . '/edit')->with('success', Lang::get('admin/videos/messages.create.success'));
            }

            // Redirect to the video video create page
            return Redirect::to('admin/videos/create')->with('error', Lang::get('admin/videos/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/videos/create')->withInput()->withErrors($validator);
	}
        
    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate2()
	{
        // Title
        $title = 'Добавление видео';

        // Show the page
        return View::make('site/video/create', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate2()
	{
        // Declare the rules for the form validation
        $rules = array(
            'user' => 'required|min:5',
            'link'   => 'required|min:10',
            'description' => 'required|min:10'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new video 
            $user = Auth::user();

            // Update the video data
            $this->video->link            = Input::get('link');
            $this->video->description     = Input::get('description');
            $this->video->user            = Input::get('user');

            // Was the video created?
            if($this->video->save())
            {
                // Redirect to the new video page
                return Redirect::to('videos/v')->with('success', Lang::get('user/user.user_video_created'));
            }

            // Redirect to the video video create page
            return Redirect::to('admin/videos/create')->with('error', Lang::get('admin/videos/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/videos/create')->withInput()->withErrors($validator);
	}
            

    /**
     * Display the specified resource.
     *
     * @param $video
     * @return Response
     */
	public function getShow($video)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $video
     * @return Response
     */
	public function getEdit($video)
	{
        // Title
        $title = Lang::get('admin/videos/title.video_update');

        // Show the page
        return View::make('admin/videos/create_edit', compact('video', 'title'));
	}
        
    /**
     * Update the specified resource in storage.
     *
     * @param $video
     * @return Response
     */
	public function postEdit($video)
	{

        // Declare the rules for the form validation
        $rules = array(
            'user' => 'required|min:5',
            'link'   => 'required|min:10',
            'description' => 'required|min:10'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the video video data
            $video->user            = Input::get('user');
            $video->link            = Input::get('link');
            $video->description          = Input::get('description');
            // Was the video video updated?
            if($video->save())
            {
                // Redirect to the new video video page
                return Redirect::to('admin/videos/' . $video->id . '/edit')->with('success', Lang::get('admin/videos/messages.update.success'));
            }

            // Redirect to the videos video management page
            return Redirect::to('admin/videos/' . $video->id . '/edit')->with('error', Lang::get('admin/videos/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/videos/' . $video->id . '/edit')->withInput()->withErrors($validator);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $video
     * @return Response
     */
    public function getDelete($video)
    {
        // Title
        $title = Lang::get('admin/videos/title.video_delete');

        // Show the page
        return View::make('admin/videos/delete', compact('video', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $video
     * @return Response
     */
    public function postDelete($video)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $video->id;
            $video->delete();

            // Was the video video deleted?
            $video = Video::find($id);
            if(empty($video))
            {
                // Redirect to the video videos management page
                return Redirect::to('admin/videos')->with('success', Lang::get('admin/videos/messages.delete.success'));
            }
        }
        // There was a problem deleting the video video
        return Redirect::to('admin/videos')->with('error', Lang::get('admin/videos/messages.delete.error'));
    }
    
     /**
     * Remove the specified resource from storage.
     *
     * @param $video
     * @return Response
     */
    public function getModerate($video)
    {
        // Title
        $title = Lang::get('admin/videos/title.video_moderate');

        // Show the page
        return View::make('admin/videos/moderate', compact('video', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $video
     * @return Response
     */
    public function postModerate($video)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $video->id;
            $video->moderated = true;

            // Was the video video moderated?
            if($video->save())
            {
                // Redirect to the video management page
                return Redirect::to('admin/videos/' . $video->id . '/moderate')->with('success', Lang::get('admin/videos/messages.moderate.success'));
            }
        }
        // There was a problem deleting the video video
        return Redirect::to('admin/videos/' . $video->id . '/moderate')->with('error', Lang::get('admin/videos/messages.moderate.error'));
    }

    /**
     * Show a list of all the video videos formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $videos = Video::select(array('videos.id', 'videos.link', 'videos.description', 'videos.user' , 'videos.moderated', 'videos.created_at'));
        return Datatables::of($videos)

        ->edit_column('moderated','@if($moderated)
                            Да
                        @else
                            Нет
                        @endif')
        ->add_column('actions', '<a href="{{{ URL::to(\'admin/videos/\' . $id . \'/moderate\' ) }}}" class="btn btn-success btn-xs iframe" >{{{ Lang::get(\'button.moderate\') }}}</a>
                <a href="{{{ URL::to(\'admin/videos/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.otclonit\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }
    
     /**
     * Show a list of all the video videos formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData2()
    {
        $videos = Video::select(array('videos.id', 'videos.link', 'videos.description', 'videos.user' , 'videos.moderated', 'videos.created_at'));
        return Datatables::of($videos)

        ->edit_column('moderated','@if($moderated)
                            Да
                        @else
                            Нет
                        @endif')
        ->add_column('actions', '<a href="{{{ URL::to(\'admin/videos/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>')

        ->remove_column('id')

        ->make();
    }

}