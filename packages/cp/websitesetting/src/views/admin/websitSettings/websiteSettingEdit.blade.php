@extends('admin::layouts.adminMaster')
@section('title')
    | website Setting
@endsection

@push('css')
@endpush

@section('content') 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Website Setting</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Website Setting</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<section class="content">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="card-title">Website Setting</div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.websiteSettingUpdate',$ws->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                        <div class="card-body" style="background-color: #ccc;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-widget">
                                        <div class="card-body">
                                            <div class="form-group ">
                                                <label for="website_title" class="  control-label">Website Title </label>
                                                <input type="text" name="website_title" class="form-control" value="{{ old('website_title') ?: $ws->website_title ?? '' }}" id="website_title" placeholder="Short Title for Admin Left Sidebar" autocomplete="off">
                                            </div>

                                            <div class="form-group ">
                                                <label for="google_search_console" class="control-label"> Google Search Console
                                                    Code
                                                </label>
                                                <textarea name="google_search_console" class="form-control textarea" rows="2" id="google_search_console" placeholder="Job ws instraction">{{ old('google_search_console') ?: $ws->google_search_console ?? '' }}</textarea>
                                            </div>



                                            <div class="form-group ">
                                                <label for="google_analytics_code" class="control-label"> Google Analytics
                                                    (Tracking) Code </label>
                                                <textarea name="google_analytics_code" class="form-control" rows="2" id="google_analytics_code" placeholder="Google Analytics Code (Tracking Code)">{{ old('google_analytics_code') ?: $ws->google_analytics_code ?? '' }}</textarea>

                                            </div>

                                            <div class="form-group ">
                                                <label for="facebook_pixel_code" class="control-label"> Facebook (Pixel) Code
                                                </label>
                                                <textarea name="facebook_pixel_code" class="form-control" rows="2" id="facebook_pixel_code" placeholder="Facebook Pixel Code (Tracking Code)">{{ old('facebook_pixel_code') ?: $ws->facebook_pixel_code ?? '' }}</textarea>
                                            </div>


                                            <div class="form-group ">
                                                <label for="footer_address" class="control-label"> Footer Address </label>
                                                <textarea name="footer_address" class="form-control" rows="2" id="footer_address" placeholder="Enter footer address">{{ old('footer_address') ?: $ws->footer_address ?? '' }}</textarea>

                                            </div>

                                            <div class="form-group ">
                                                <label for="footer_contact" class="control-label"> Footer Contact
                                                </label>
                                                <textarea name="footer_contact" class="form-control" rows="2" id="footer_contact" placeholder="Enter Footer contact">{{ old('footer_contact') ?: $ws->footer_contact ?? '' }}</textarea>
                                            </div>

                                            <div class="form-group ">
                                                <label for="footer_bottom_bg_color" class="control-label"> Footer Bottom Bg Color </label>
                                                <input type="text" name="footer_bottom_bg_color" class="form-control" value="{{ old('footer_bottom_bg_color') ?: $ws->footer_bottom_bg_color ?? '' }}" id="footer_bottom_bg_color" placeholder="Enter footer bottom bg color">

                                            </div>

                                            <div class="form-group ">
                                                <label for="footer_bottom_text_color" class="control-label"> Footer Bottom Text Color
                                                </label>
                                                <input type="text" name="footer_bottom_text_color" class="form-control" value="{{ old('footer_bottom_text_color') ?: $ws->footer_bottom_text_color ?? '' }}" id="footer_bottom_text_color" placeholder="Enter footer bottom text color">
                                            </div>


                                        </div>
                                    </div>


                                </div>


                                <div class="col-sm-6">

                                    <div class="card card-widget">
                                        <div class="card-body">
                                            <div class="form-group ">
                                                <label for="meta_author" class="  control-label">Meta Author for Website</label>
                                                <input type="text" name="meta_author" class="form-control" value="{{ old('meta_author') ?: $ws->meta_author ?? '' }}" id="meta_author" placeholder="Meta Author for SEO of website" autocomplete="off">
                                            </div>

                                            <div class="form-group ">
                                                <label for="meta_description" class="control-label">Meta Description </label>
                                                <textarea name="meta_description" class="form-control" rows="4" id="meta_description" placeholder="Meta Description for SEO of Website">{{ old('meta_description') ?: $ws->meta_description ?? '' }}</textarea>
                                            </div>

                                            <div class="form-group ">
                                                <label for="footer_copyright" class="control-label">Footer Copyright Text</label>
                                                <textarea name="footer_copyright" class="form-control" rows="4" id="footer_copyright" placeholder="Copyright text in footer area">{{ old('footer_copyright') ?: $ws->footer_copyright ?? '' }}</textarea>
                                            </div>


                                            <div class="form-group ">
                                                <label for="fb_url" class="  control-label">Facebook Page Url</label>
                                                <input type="text" name="fb_url" class="form-control" value="{{ old('fb_url') ?: $ws->fb_url ?? '' }}" id="fb_url" placeholder="https://facebook.com/page.username" autocomplete="off">
                                            </div>

                                            <div class="form-group ">
                                                <label for="contact_mobile" class="  control-label">Contact Address</label>
                                                <input type="text" name="contact_address" class="form-control" value="{{ old('contact_address') ?: $ws->contact_address ?? '' }}" id="contact_address" placeholder="+address" autocomplete="off">
                                            </div>

                                            <div class="form-group ">
                                                <label for="contact_mobile" class="  control-label">Contact Mobile</label>
                                                <input type="text" name="contact_mobile" class="form-control" value="{{ old('contact_mobile') ?: $ws->contact_mobile ?? '' }}" id="contact_mobile" placeholder="+055654646515" autocomplete="off">
                                            </div>

                                            <div class="form-group ">
                                                <label for="contact_email" class="  control-label">Contact email</label>
                                                <input type="text" name="contact_email" class="form-control" value="{{ old('contact_email') ?: $ws->contact_email ?? '' }}" id="contact_email" placeholder="example@.com" autocomplete="off">
                                            </div>

                                            <div class="form-group ">
                                                <label for="twitter_url" class="  control-label">Twitter Url</label>
                                                <input type="text" name="twitter_url" class="form-control" value="{{ old('twitter_url') ?: $ws->twitter_url ?? '' }}" id="twitter_url" placeholder="Twitter url" autocomplete="off">
                                            </div>

                                            <div class="form-group ">
                                                <label for="linkedin_url" class=" control-label">Linkedin Url</label>
                                                <input type="text" name="linkedin_url" class="form-control" value="{{ old('twitter_url') ?: $ws->linkedin_url ?? '' }}" id="linkedin_url" placeholder="Linkedin Url" autocomplete="off">
                                            </div>

                                            <div class="form-group ">
                                                <label for="youtube_url" class="  control-label">Youtube Url</label>
                                                <input type="text" name="youtube_url" class="form-control" value="{{ old('youtube_url') ?: $ws->youtube_url ?? '' }}" id="youtube_url" placeholder="Youtube Url" autocomplete="off">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header bg-info">SEO Part For Home Page</div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <fieldset>
                                                        <legend>Twitter Card data</legend>
                                                        <div class="form-group">
                                                            <label for="twitter_title">Twitter Title </small></label>
                                                            <input type="text" name="twitter_title" value="{{ old('twitter_title') ?: $ws->twitter_title ?? '' }}" class="form-control  " id="twitter_title">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="twitter_description">Twitter Description</label>
                                                            <textarea name="twitter_description" id="twitter_description" cols="30" rows="3" class="form-control  ">{{ old('twitter_description') ?: $ws->twitter_description ?? '' }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="twitter_creator">Twitter Creator</label> <br>
                                                            <input type="text" name="twitter_creator" value="{{ old('twitter_creator') ?: $ws->twitter_creator ?? '' }}" class="form-control  " id="twitter_creator">
                                                        </div>
                                                    </fieldset>

                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <fieldset>
                                                        <legend>Open Graph data</legend>
                                                        <div class="form-group">
                                                            <label for="og_title">OG Title </label>
                                                            <input type="text" name="og_title" value="{{ old('og_title') ?: $ws->og_title ?? '' }}" class="form-control  " id="og_title">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="og_description">OG Description</label>
                                                            <textarea name="og_description" id="og_description" cols="30" rows="3" class="form-control  ">{{ old('og_description') ?: $ws->og_description ?? '' }}</textarea>
                                                        </div>

                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card card-widget">
                                        <div class="card-header with-border">
                                            <h3 class="card-title">Update Favicon </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-group ">
                                                        <label for="favicon" class="col-sm-3 control-label">favicon</label>
                                                        <div class="col-sm-9">
                                                            <input type="file" name="favicon" class="" id="favicon">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="w3-display-container" style="height:110px;">
                                                    <img class="img-responsive" style="width: 50px;" src="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}" alt="" id="showFavicon">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>



                                </div>
                                <div class="col-sm-6">
                                    <div class="card card-widget">
                                        <div class="card-header with-border">
                                            <h3 class="card-title">Update Logo</h3>
                                        </div>
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-group ">
                                                        <label for="logo" class="col-sm-3 control-label">Logo</label>
                                                        <div class="col-sm-9">
                                                            <input type="file" name="logo" class="" id="logo">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="w3-display-container" style="max-height:110px;">
                                                        <img class="img-responsive" style="max-width: 100%;" src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $ws->logo()]) }}" alt="" id="showLogo">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="card card-widget">
                                        <div class="card-header with-border">
                                            <h3 class="card-title">Update alternate Logo</h3>
                                        </div>
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-group ">
                                                        <label for="logo_alt" class="col-sm-4 control-label">Alt Logo</label>
                                                        <div class="col-sm-8">
                                                            <input type="file" name="logo_alt" class="" id="logo_alt">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="w3-display-container" style="height:110px;">
                                                        <img class="img-responsive" style="max-width: 100%;" src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $ws->logo_alt()]) }}" alt="" id="showLogoAlt">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                                <div class="col-sm-6">
                                    <div class="card card-widget">
                                        <div class="card-header with-border">
                                            <h3 class="card-title">Footer Image</h3>
                                        </div>
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-group ">
                                                        <label for="logo_alt" class="col-sm-5 control-label">Footer Image</label>
                                                        <div class="col-sm-7">
                                                            <input type="file" name="footer_image" class="" id="footer_image">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="w3-display-container" style="height:110px;">
                                                        <img class="img-responsive" style="max-width: 100%;" src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $ws->footerImage()]) }}" alt="" id="showLogoAlt">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary pull-right">Update</button>
                        </div>
                    </form>
                </div>
            </div>

       

</section>

@endsection


@push('js')
<script>
    $( document ).ready(function() {
        $('#logo').change(function(e){
            var reader = new FileReader();
            reader.onload=function(e){
                $('#showLogo').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

        $('#favicon').change(function(e){
            var reader = new FileReader();
            reader.onload=function(e){
                $('#showFavicon').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

        $('#logo_alt').change(function(e){
            var reader = new FileReader();
            reader.onload=function(e){
                $('#showLogoAlt').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
        showLogoAlt
    });
</script>
@endpush
