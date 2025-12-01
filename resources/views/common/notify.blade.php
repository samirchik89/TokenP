   @if (isset($errors) && count($errors) > 0)

       <div class="alert alert-danger" @if (@$investor) style="margin-top: 16px; margin-bottom: 16px;" @endif>
           <button type="button" class="btn-close" @if (@$investor) style="margin-right: 1.5rem" @endif
               data-bs-dismiss="alert" aria-label="Close"></button>
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
   @endif

   @if (Session::has('flash_error'))
       <div class="alert alert-danger" @if (@$investor) style="margin-top: 16px; margin-bottom: 16px;" @endif>
           <button type="button" class="btn-close" @if (@$investor) style="margin-right: 1.5rem" @endif
               data-bs-dismiss="alert" aria-label="Close"></button>
           {{ Session::get('flash_error') }}
       </div>
   @endif


   @if (Session::has('flash_success'))
       <div class="alert alert-success" @if (@$investor) style="margin-top: 16px; margin-bottom: 16px;" @endif>
           <button type="button" class="btn-close" @if (@$investor) style="margin-right: 1.5rem" @endif
               data-bs-dismiss="alert" aria-label="Close"></button>
           {{ Session::get('flash_success') }}
       </div>
   @endif

   @if (Session::has('flash_warning'))
       <div class="alert alert-warning" @if (@$investor) style="margin-top: 16px; margin-bottom: 16px;" @endif>
           <button type="button" class="btn-close" @if (@$investor) style="margin-right: 1.5rem" @endif
               data-bs-dismiss="alert" aria-label="Close"></button>
           {{ Session::get('flash_warning') }}
       </div>
   @endif
