@extends('admin::layouts.adminMaster')
@section('title')
    | Translation
@endsection

@push('css')
@endpush

@section('content') 

    <br>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
            <div class="card-header">
          <h3 class="card-title">{{$language->title}}</h3>

          <div class="card-tools">
            <div class="input-group mr-2">
              <input type="search" name="q"  class="language-tranlation form-control float-right" data-url="{{ route('admin.languageTranlationSearchAjax',[ 'id'=> $language->id]) }}"  placeholder="Type key">
                  <div class="input-group-append ">
                      <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                      </button>
                  </div>
              </div>
          </div>
        </div>
         <form class="form-horizontal" action="{{ route('admin.languageTranslateValueStore') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $language->id }}">
            <div class="card-body">
                <div class="table-responsive language-container">
                  @includeIf('admin::translations.searchLanguageTranslation')
                </div>

                <br>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">save</button>
                </div>
            </div>
            <div class="card-footer">
               {{ $lang_keys->links() }}
            </div>
        </form>
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection



@push('js')
<script>
  $(document).ready(function () {
    $(document).on('keyup', ".language-tranlation", function(e){

        e.preventDefault();
        var that = $( this );
        var url = that.attr('data-url');
        var q = that.val();

        $.ajax({
              url: url,
              data : {q:q},
              method: "get",
              success: function(res)
              {
                if(res.success)
                {
                    $(".language-container").empty().append(res.page);
                }
              }
        });
    });


    $(document).on('click', '.pagination a', function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      $.ajax({
              url: url,
              method: "get",
              success: function(res)
              {
                if(res.success)
                {
                    $(".language-container").empty().append(res.page);
                }
              }
        });
            
    });

  });
</script>
@endpush
