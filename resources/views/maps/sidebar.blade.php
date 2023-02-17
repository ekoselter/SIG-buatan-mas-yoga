<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <div class="accordion accordion-flush px-1" id="accordionFlushExample" style="margin-top: -40px">
          {{-- menampilkan data kategori --}}
          @foreach ($categories as $category)
            <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $category->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $category->id }}">
                <i class="bi {{ $category->icon_parent }}"></i>
                &nbsp;{{ $category->cat_name }}
              </button>
            </h2>
              <div id="flush-collapse{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                {{-- menampilkan data kategori --}}
                @foreach ($category_children as $child)
                  @if ($child->parent_id == $category->id) 
                    <a class="btn nav-link fw-normal text-start" id="{{ $child->id }}" type="button" onclick="selectMap('<?= $child->id ?>')">&emsp;&emsp;<i class="bi {{ $category->icon_child }}"></i> {{ $child->catchild_name }}</a>
                  @endif
                @endforeach
              </div>
          </div>
          @endforeach
        </div>
      </li>
    </ul>
  </div>
</nav>