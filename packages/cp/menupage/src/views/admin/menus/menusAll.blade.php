@extends('admin::layouts.adminMaster')
@section('title')
    | Menus All
@endsection

@push('css')
@endpush

@section('content') 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menus All</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Menus All</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 <section class="content">

     <!-- Default box -->
      <div class="card">
        <div class="card-header bg-info">
            <h4 class="card-title">Create New Menu</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.menusAll') }}"> Back</a>
            </div>
        </div>
        <form action="{{ route('admin.menuStore')}}" method="post">
          @csrf
          <div class="card-body">
            <div class="card card-widget mb-0">
              <div class="card-body w3-gray">
                <div class="card card-widget mb-0 text-dark">
                  <div class="card-body">
                    <div class="card-body">
                      <div class="form-group">
                          <label for="">Menu Name</label>
                          <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Enter Menu Name">
                          @error('name')
                          <span style="color:red">{{ $message }}</span>
                          @enderror
                      </div>

                      <div class="form-group">
                          <label for="">Menu Type</label>
                          <select name="type" id="type" class="form-control">
                              <option value="">select menu type</option>
                              @foreach (config('parameter.menu_type') as $item)
                                  <option value="{{ $item }}" {{ old('menu_type') == $item  ? 'selected' : ' '}}>{{ $item }}</option>
                                @endforeach
                          </select>
                          @error('type')
                           <span style="color:red">{{ $message }}</span>
                          @enderror
                      </div>


                      <div class="form-group">
                          <label for="">Menu Link</label>
                          <input type="text" name="link" class="form-control" value="{{old('link')}}" placeholder="Enter Menu link">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          </div>

        </form>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

      <div class="card card-widget" style="font-size: 16px;">
        <div class="card-header with-border">
            <h3 class="card-title"><i class="fa fa-th"></i> All Menus</h3>
            <div class="card-tools">
            </div>
        </div>

        <div class="card-body">
            <div class="card card-widget mb-0">
              <div class="card-body w3-gray pb-0">
                <div class="row data-container">
                  <div class="col-sm-12 connectedSortable ui-sortable" id="sortablePanel"  data-url="{{ route('admin.menuSort') }}">
                    @foreach ($menus as $menu)
                      <div class="card card-widget ui-sortable-handle text-dark" id="{{ $menu->id }}">
                        <div class="card-body">
                          <i title="Drag up or down" class="fas fa-arrows-alt-v" style="cursor: pointer"></i>
                          Menu ID: <b>{{ $menu->id }}</b>,
                          Menu Name: <b> {{ $menu->name }}</b>,
                          Active:
                          @if($menu->active == 1)
                          <b>
                              Yes
                          </b>,
                          @else
                          <b>
                              No
                          </b>,
                          @endif
                          Menu Type: <b>{{ $menu->type }}</b>,

                          List In Page:
                          <?php $i = 1; $len = count($menu->pages); ?>
                          @foreach($menu->pages as $page)
                          <b>
                            {{ $page->name }}
                          </b>
                          <?php if($i < $len) {echo ',';} $i++;?>
                          @endforeach
                        
                           <div class="float-right d-flex">
                              <a class="btn btn-success btn-sm mr-1" href="{{ route('admin.menuShow',$menu->id)}}">Show</a>
                              <a class="btn btn-primary btn-sm mr-1" href="{{ route('admin.menuEdit',$menu->id)}}">Edit</a>

                              <form action="{{ route('admin.menuDelete',$menu->id)}}" method="post" onclick="return confirm('Do you really want to delete?');">
                                @csrf
                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                              </form>
                            </div>



                          {{-- link and copy start --}}
                        
                            &nbsp;
                            @if($menu->link)
                            <button class="copyboard btn badge badge-primary text-white" data-id="{{ $menu->id }}"  data-text="{{ $menu->link }}">
                                Copy url
                            </button>
                            <a target="_blank" href="{{ $menu->link }}" class="badge badge-primary">View</a>
                            @else
                            @endif

                          {{-- link and copy end --}}


                        </div>
                      </div>
                    @endforeach

                  </div>
                </div>
              </div>
             
            </div>
        </div>

        <div class="card-footer">
            {{ $menus->render() }}
        </div>
      </div>


    </section>

@endsection



@push('js')
    <script>
         $( document ).ready(function() {
            $("#sortablePanel").sortable({

              connectWith: ".connectedSortable",
              distance: 5,
              delay: 300,
              opacity: 0.6,
              cursor: 'move',

              update: function() {
                  var order = $('#sortablePanel').sortable('toArray'),
                      url = $("#sortablePanel").attr('data-url');
                  $.ajax({
                      url: url,
                      type: 'get',
                      cache: false,
                      dataType: 'json',
                      data: {
                          sorted_data: order
                      },
                      success: function(response) {
                          if (response.success == true) {} else {
                              alert('fail');
                          }
                      },
                      error: function() {}
                  }); //ajax
              }
            }).disableSelection();



            $(document).on('click', '.copyboard', function(e) {
            e.preventDefault();

            $(".copyboard").text('Copy url');
            $(this).text('Coppied!');
            var copyText = $(this).attr('data-text');

            var textarea = document.createElement("textarea");
            textarea.textContent = copyText;
            textarea.style.position = "fixed";
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");

            document.body.removeChild(textarea);
           });
           
         });
    </script>
@endpush
