   <!-- START BREADCRUMN -->
   <section class="au-breadcrumb m-t-100">
    <div class="section__content section__content--p30">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="au-breadcrumb-content">
              <div class="au-breadcrumb-left">
                <span class="au-breadcrumb-span">You are here:</span>
                <ul class="list-unstyled list-inline au-breadcrumb__list">
                  <li class="list-inline-item active">
                    <a href="{{ route('home') }}">Home</a>
                  </li>
                  <li class="list-inline-item seprate">
                    <span>/</span>
                  </li>
                  @for($i = 1; $i <= count(Request::segments()); $i++)
                  @if($i >= 3)
                  @break
                  @endif
                  <li class="list-inline-item">
                   <a href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true)))}}">
                    {{strtoupper(Request::segment($i))}}
                  </a>
                  <li class="list-inline-item seprate">
                    <span>/</span>
                  </li>
                </li>
                @endfor
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END BREADCRUMB -->

