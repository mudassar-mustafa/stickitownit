<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->
        @hasanyrole('SuperAdmin|Admin|Seller')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('backend.pages.users.index') }}">
                    <i class="bi bi-person"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('backend.pages.brand.index') }}">
                    <i class="bi bi-bag-x"></i>
                    <span>Brands</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('backend.pages.categories.index') }}">
                    <i class="bi bi-type"></i>
                    <span>Category</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('backend.pages.features.index') }}">
                    <i class="bi bi-database"></i>
                    <span>Features</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('backend.pages.faqs.index') }}">
                    <i class="bi bi-question"></i>
                    <span>FAQs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#locations-nav" data-bs-toggle="collapse" href="#"
                   aria-expanded="true">
                    <i class="bi bi-map-fill"></i><span>Locations</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="locations-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                    <li>
                        <a href="{{ route('backend.pages.country.index') }}">
                            <i class="bi bi-circle"></i><span>Country</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('backend.pages.state.index') }}">
                            <i class="bi bi-circle"></i><span>State</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('backend.pages.city.index') }}">
                            <i class="bi bi-circle"></i><span>City</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#blogs-nav" data-bs-toggle="collapse" href="#"
                   aria-expanded="false">
                    <i class="bi bi-newspaper"></i><span>Blogs</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="blogs-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                    <li>
                        <a href="{{ route('backend.pages.blogs-categories.index') }}">
                            <i class="bi bi-circle"></i><span>Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('backend.pages.blogs-tags.index') }}">
                            <i class="bi bi-circle"></i><span>Tags</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('backend.pages.blogs.index') }}">
                            <i class="bi bi-circle"></i><span>Blogs</span>
                        </a>
                    </li>
                </ul>
            </li>
    
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#products-nav" data-bs-toggle="collapse" href="#"
                   aria-expanded="false">
                    <i class="bi bi-basket"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="products-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                    <li>
                        <a  href="{{ route('backend.pages.product.index') }}">
                            <i class="bi bi-basket"></i><span>Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('backend.pages.attribute.index') }}">
                            <i class="bi bi-database"></i><span>Attributes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('backend.pages.attribute-value.index') }}">
                            <i class="bi bi-database"></i><span>Attributes Values</span>
                        </a>
                    </li>
                </ul>
            </li>
    
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('backend.pages.package.index') }}">
                    <i class="bi bi-stripe"></i>
                    <span>Packages</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('backend.pages.page.index') }}">
                    <i class="bi bi-info"></i>
                    <span>Pages</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('backend.pages.sticker.index') }}">
                    <i class="bi bi-printer"></i>
                    <span>Stickers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('backend.pages.contact-us.index') }}">
                    <i class="bi bi-messenger"></i>
                    <span>Contact Us</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('backend.pages.quote.index') }}">
                    <i class="bi bi-quote"></i>
                    <span>Get a Quote</span>
                </a>
            </li>    
        @endhasanyrole

        @hasanyrole('SuperAdmin|Admin|Seller|Customer')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('backend.pages.order.sale_order') }}">
                    <i class="bi bi-quote"></i>
                    <span>Sale Order</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('backend.pages.order.package_order') }}">
                    <i class="bi bi-quote"></i>
                    <span>Package Order</span>
                </a>
            </li>
        @endhasanyrole

        @hasanyrole('Customer')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('backend.pages.package-subscription.index') }}">
                    <i class="bi bi-quote"></i>
                    <span>Package Subscription</span>
                </a>
            </li>
        @endhasanyrole
        

        {{-- <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="forms-elements.html">
                <i class="bi bi-circle"></i><span>Form Elements</span>
              </a>
            </li>
            <li>
              <a href="forms-layouts.html">
                <i class="bi bi-circle"></i><span>Form Layouts</span>
              </a>
            </li>
            <li>
              <a href="forms-editors.html">
                <i class="bi bi-circle"></i><span>Form Editors</span>
              </a>
            </li>
            <li>
              <a href="forms-validation.html">
                <i class="bi bi-circle"></i><span>Form Validation</span>
              </a>
            </li>
          </ul>
        </li><!-- End Forms Nav --> --}}

        {{-- <li class="nav-heading">Pages</li> --}}

    </ul>

</aside>
