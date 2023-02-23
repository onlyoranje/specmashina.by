<!DOCTYPE html><!-- This site was created in Webflow. https://www.webflow.com --><!-- Last Published: Thu Sep 01 2022 15:36:03 GMT+0000 (Coordinated Universal Time) -->
<html >
<head>
    <meta charset="utf-8"/>
    <title>@yield('title') :: Объявления</title>
    <meta        name="description"/>
    <meta content="" property="og:title"/>
    <meta       content=""        property="og:description"/>
    <meta
        content=""     property="og:image"/>


    @vite(['resources/js/app.js'])
<body class="bg-neutral-100">
<div class="page-wrapper">
    <div data-collapse="medium" data-animation="default" data-duration="400"
         data-w-id="58db7844-5919-d71b-dd74-2323ed8dffe9" data-easing="ease" data-easing2="ease" role="banner"
         class="header w-nav">
        <div class="container-default container-header w-container"><a href="/" class="brand w-nav-brand"><img
                    src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec5ed71d0d5ff214b3d1e4f_Logo.svg"
                    alt="Jobs Webflow Template - Logo" class="header-logo"/></a>
            <div role="navigation" class="nav-menu-container w-nav-menu">
                <div class="spacer header-mobile"></div>
                <div class="nav-menu">
                    <ul role="list" class="header-navigation">
                        <li class="nav-item-wrapper"><a href="/home-v1" class="nav-link">Home</a></li>
                        <li class="nav-item-wrapper">
                            <div data-hover="false" data-delay="0" data-w-id="c89a5bfc-ba88-45a9-7b11-59fc248dfed7"
                                 class="w-dropdown">
                                <div class="dropdown-toggle w-dropdown-toggle">
                                    <div>Categories</div>
                                    <div class="arrow-icon"></div>
                                </div>
                                <nav class="dropdown-menu-list w-dropdown-list"><a
                                        href="https://jobstemplate.webflow.io/job-category/development"
                                        class="dropdown-link w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec5f68966486f7009037699_developer-dropdown-icon.svg"
                                            alt="Development- Jobs Webflow Template" class="dropdown-icon"/>
                                        <div>Development</div>
                                    </a><a href="https://jobstemplate.webflow.io/job-category/design"
                                           class="dropdown-link w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec5f689e2d02e4011239330_design-dropdown-icon.svg"
                                            alt="Design- Jobs Webflow Template" class="dropdown-icon"/>
                                        <div>Design</div>
                                    </a><a href="https://jobstemplate.webflow.io/job-category/marketing"
                                           class="dropdown-link w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec5f689fe35e2e8dfb0a323_marketing-dropdown-icon.svg"
                                            alt="Marketing- Jobs Webflow Template" class="dropdown-icon"/>
                                        <div>Marketing</div>
                                    </a><a href="https://jobstemplate.webflow.io/job-category/business"
                                           class="dropdown-link w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec5f68910ee74175dab8162_business-dropdown-icon.svg"
                                            alt="Business- Jobs Webflow Template" class="dropdown-icon"/>
                                        <div>Business</div>
                                    </a><a href="https://jobstemplate.webflow.io/job-category/support"
                                           class="dropdown-link w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec5f689fe35e26990b0a324_support-dropdown-icon.svg"
                                            alt="Support - Jobs Webflow Template" class="dropdown-icon"/>
                                        <div>Support</div>
                                    </a></nav>
                            </div>
                        </li>
                        <li class="nav-item-wrapper">
                            <div data-hover="false" data-delay="0" data-w-id="f826e8c7-635e-7140-5a72-e28520880bc2"
                                 class="w-dropdown">
                                <div class="dropdown-toggle w-dropdown-toggle">
                                    <div>Pages</div>
                                    <div class="arrow-icon"></div>
                                </div>
                                <nav class="dropdown-menu-list _2-columns w-dropdown-list">
                                    <div class="w-layout-grid dropdown-menu-2-columns">
                                        <div>
                                            <div class="dropdown-menu-title">Pages</div>
                                            <div class="w-layout-grid submenu-grid">
                                                <div class="submenu-column"><a href="/" class="submenu-link">Sales
                                                        Home</a><a href="/home-v1" class="submenu-link">Home V1</a><a
                                                        href="/home-v2" class="submenu-link">Home V2</a><a href="/jobs"
                                                                                                           aria-current="page"
                                                                                                           class="submenu-link w--current">Jobs</a><a
                                                        href="/job/digital-marketing-specialist" class="submenu-link">Job
                                                        Post</a><a href="/pricing" class="submenu-link">Pricing</a><a
                                                        href="/post-job" class="submenu-link">Post a Job</a><a
                                                        href="/submit-resume" class="submenu-link">Submit Resume</a>
                                                </div>
                                                <div class="submenu-column"><a href="/featured-jobs"
                                                                               class="submenu-link">Featured Jobs</a><a
                                                        href="/companies" class="submenu-link">Companies</a><a
                                                        href="/company/webflow" class="submenu-link">Company
                                                        Single</a><a href="/blog" class="submenu-link">Blog</a><a
                                                        href="/blog/5-tips-to-be-prepared-for-2020-digital-marketing-trends"
                                                        class="submenu-link">Blog Post</a><a href="/about-us"
                                                                                             class="submenu-link">About
                                                        Us</a><a href="/support" class="submenu-link">Support</a></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="dropdown-menu-title">Utility Pages</div>
                                            <div class="submenu-column"><a href="/utility-pages/styleguide"
                                                                           class="submenu-link">Styleguide</a><a
                                                    href="/404" class="submenu-link">404 Not Found</a><a href="/401"
                                                                                                         class="submenu-link">Password
                                                    Protected</a><a href="/utility-pages/licenses" class="submenu-link">Licenses</a><a
                                                    href="/utility-pages/start-here" class="submenu-link">Start Here</a><a
                                                    href="/utility-pages/changelog" class="submenu-link">Changelog</a><a
                                                    href="https://brixtemplates.com/more-templates"
                                                    class="submenu-link special">More Webflow Templates</a></div>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="_2-buttons-header"><a href="/jobs" aria-current="page"
                                                  class="button-secondary button-header-secondary w-button w--current">Browse
                        Jobs</a><a href="/pricing" class="button-primary button-header-primary w-button">Post a Job</a>
                </div>
            </div>
            <div data-w-id="58db7844-5919-d71b-dd74-2323ed8dfffb" class="menu-button w-nav-button">
                <div data-is-ix2-target="1" class="menu-lottie-icon" data-w-id="9a64e014-3850-efda-23a3-56fba6ba1020"
                     data-animation-type="lottie"
                     data-src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec5f8bbe2d02e5ece239ae7_lottieflow-menu-nav-07-05152E-easey.json"
                     data-loop="0" data-direction="1" data-autoplay="0" data-renderer="svg"
                     data-default-duration="2.4791666666666665" data-duration="0" data-ix2-initial-state="0"></div>
            </div>
            <div data-node-type="commerce-cart-wrapper" data-open-product="" data-wf-cart-type="modal"
                 data-wf-cart-query="query Dynamo2 {
  database {
    id
    commerceOrder {
      comment
      extraItems {
        name
        pluginId
        pluginName
        price {
          value
          unit
          decimalValue
          string
        }
      }
      id
      startedOn
      statusFlags {
        hasDownloads
        hasSubscription
        isFreeOrder
        requiresShipping
      }
      subtotal {
        value
        unit
        decimalValue
        string
      }
      total {
        value
        unit
        decimalValue
        string
      }
      updatedOn
      userItems {
        count
        sku {
          f__draft_0ht
          f__archived_0ht
          f_sku_values_3dr {
            property {
              id
            }
            value {
              id
            }
          }
          id
        }
        price {
          value
          unit
          decimalValue
          string
        }
        product {
          id
          f__draft_0ht
          f__archived_0ht
          f_job_icon_2_3dr8dr {
            url
            file {
              size
              origFileName
              createdOn
              updatedOn
              mimeType
              width
              height
              variants {
                origFileName
                quality
                height
                width
                s3Url
                error
                size
              }
            }
            alt
          }
          f_name_
          f_sku_properties_3dr {
            id
            name
            enum {
              id
              name
              slug
            }
          }
          f_slug_
        }
        id
        rowTotal {
          value
          unit
          decimalValue
          string
        }
        subscriptionFrequency
        subscriptionInterval
        subscriptionTrial
      }
      userItemsCount
    }
  }
  site {
    id
    commerce {
      businessAddress {
        country
      }
      defaultCountry
      defaultCurrency
      quickCheckoutEnabled
    }
  }
}
" data-wf-page-link-href-prefix="" class="w-commerce-commercecartwrapper cart"><a href="#"
                                                                                  data-node-type="commerce-cart-open-link"
                                                                                  class="w-commerce-commercecartopenlink cart-buttno w-inline-block"><img
                        src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5eec15d591e2b4025565dc34_shopping-bag-side%201.svg"
                        alt="Bag - Jobs Webflow Template"/>
                    <div
                        data-wf-bindings="%5B%7B%22innerHTML%22%3A%7B%22type%22%3A%22Number%22%2C%22filter%22%3A%7B%22type%22%3A%22numberPrecision%22%2C%22params%22%3A%5B%220%22%2C%22numberPrecision%22%5D%7D%2C%22dataPath%22%3A%22database.commerceOrder.userItemsCount%22%7D%7D%5D"
                        class="w-commerce-commercecartopenlinkcount cart-quantity">0
                    </div>
                </a>
                <div data-node-type="commerce-cart-container-wrapper" style="display:none"
                     class="w-commerce-commercecartcontainerwrapper w-commerce-commercecartcontainerwrapper--cartType-modal cart-wrapper">
                    <div data-node-type="commerce-cart-container" class="w-commerce-commercecartcontainer">
                        <div class="w-commerce-commercecartheader"><h4 class="w-commerce-commercecartheading">Your
                                Cart</h4><a href="#" data-node-type="commerce-cart-close-link"
                                            class="w-commerce-commercecartcloselink w-inline-block">
                                <svg width="16px" height="16px" viewBox="0 0 16 16">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g fill-rule="nonzero" fill="#333333">
                                            <polygon
                                                points="6.23223305 8 0.616116524 13.6161165 2.38388348 15.3838835 8 9.76776695 13.6161165 15.3838835 15.3838835 13.6161165 9.76776695 8 15.3838835 2.38388348 13.6161165 0.616116524 8 6.23223305 2.38388348 0.616116524 0.616116524 2.38388348 6.23223305 8"></polygon>
                                        </g>
                                    </g>
                                </svg>
                            </a></div>
                        <div class="w-commerce-commercecartformwrapper">
                            <form data-node-type="commerce-cart-form" style="display:none"
                                  class="w-commerce-commercecartform">
                                <script type="text/x-wf-template"
                                        id="wf-template-2c76bc54-c15b-04bf-e5e8-b75141368800">%3Cdiv%20class%3D%22w-commerce-commercecartitem%22%3E%3Ca%20data-wf-bindings%3D%22%255B%257B%2522dataWHref%2522%253A%257B%2522type%2522%253A%2522PlainText%2522%252C%2522filter%2522%253A%257B%2522type%2522%253A%2522detailPage%2522%252C%2522params%2522%253A%255B%25225eeac0d6a317b70070037afb%2522%255D%257D%252C%2522dataPath%2522%253A%2522database.commerceOrder.userItems%255B%255D.product.f_slug_%2522%252C%2522collectionSlugMap%2522%253A%257B%2522COMMERCE_CART_COLLECTION_ID%2522%253A%2522cart%2522%252C%25225ec968d7d0fb9b3992a6555b%2522%253A%2522blog-category%2522%252C%25225ec9695e8d949f0627c6805b%2522%253A%2522author%2522%252C%25225ec724b60a860f0e046830ea%2522%253A%2522job-category%2522%252C%25225ec722b32d8f477d090a77b7%2522%253A%2522job%2522%252C%25225eeac0d6a317b7174d037afc%2522%253A%2522sku%2522%252C%25225eeac0d6a317b714a7037afa%2522%253A%2522category%2522%252C%25225ec968bf06d25cb56010b11b%2522%253A%2522blog%2522%252C%25225eeac0d6a317b70070037afb%2522%253A%2522product%2522%252C%25225ec723a93fc8c015b347a355%2522%253A%2522company%2522%252C%2522COMMERCE_ORDER_USER_ITEMS_COLLECTION_ID%2522%253A%2522userItems%2522%257D%257D%257D%255D%22%20href%3D%22%23%22%20class%3D%22w-inline-block%22%3E%3Cimg%20data-wf-bindings%3D%22%255B%257B%2522src%2522%253A%257B%2522type%2522%253A%2522ImageRef%2522%252C%2522filter%2522%253A%257B%2522type%2522%253A%2522identity%2522%252C%2522params%2522%253A%255B%255D%257D%252C%2522dataPath%2522%253A%2522database.commerceOrder.userItems%255B%255D.product.f_job_icon_2_3dr8dr%2522%257D%257D%255D%22%20src%3D%22%22%20alt%3D%22%22%20class%3D%22w-commerce-commercecartitemimage%20w-dyn-bind-empty%22%2F%3E%3C%2Fa%3E%3Cdiv%20class%3D%22w-commerce-commercecartiteminfo%22%3E%3Cdiv%20data-wf-bindings%3D%22%255B%257B%2522innerHTML%2522%253A%257B%2522type%2522%253A%2522PlainText%2522%252C%2522filter%2522%253A%257B%2522type%2522%253A%2522identity%2522%252C%2522params%2522%253A%255B%255D%257D%252C%2522dataPath%2522%253A%2522database.commerceOrder.userItems%255B%255D.product.f_name_%2522%257D%257D%255D%22%20class%3D%22w-commerce-commercecartproductname%20checkout-product-title%20w-dyn-bind-empty%22%3E%3C%2Fdiv%3E%3Cdiv%20data-wf-bindings%3D%22%255B%257B%2522innerHTML%2522%253A%257B%2522type%2522%253A%2522CommercePrice%2522%252C%2522filter%2522%253A%257B%2522type%2522%253A%2522price%2522%252C%2522params%2522%253A%255B%255D%257D%252C%2522dataPath%2522%253A%2522database.commerceOrder.userItems%255B%255D.price%2522%257D%257D%255D%22%3E%24%C2%A00.00%C2%A0USD%3C%2Fdiv%3E%3Cscript%20type%3D%22text%2Fx-wf-template%22%20id%3D%22wf-template-2c76bc54-c15b-04bf-e5e8-b75141368806%22%3E%253Cli%253E%253Cspan%2520data-wf-bindings%253D%2522%25255B%25257B%252522innerHTML%252522%25253A%25257B%252522type%252522%25253A%252522PlainText%252522%25252C%252522filter%252522%25253A%25257B%252522type%252522%25253A%252522identity%252522%25252C%252522params%252522%25253A%25255B%25255D%25257D%25252C%252522dataPath%252522%25253A%252522database.commerceOrder.userItems%25255B%25255D.product.f_sku_properties_3dr%25255B%25255D.name%252522%25257D%25257D%25255D%2522%2520class%253D%2522w-dyn-bind-empty%2522%253E%253C%252Fspan%253E%253Cspan%253E%253A%2520%253C%252Fspan%253E%253Cspan%2520data-wf-bindings%253D%2522%25255B%25257B%252522innerHTML%252522%25253A%25257B%252522type%252522%25253A%252522CommercePropValues%252522%25252C%252522filter%252522%25253A%25257B%252522type%252522%25253A%252522identity%252522%25252C%252522params%252522%25253A%25255B%25255D%25257D%25252C%252522dataPath%252522%25253A%252522database.commerceOrder.userItems%25255B%25255D.product.f_sku_properties_3dr%25255B%25255D%252522%25257D%25257D%25255D%2522%2520class%253D%2522w-dyn-bind-empty%2522%253E%253C%252Fspan%253E%253C%252Fli%253E%3C%2Fscript%3E%3Cul%20data-wf-bindings%3D%22%255B%257B%2522optionSets%2522%253A%257B%2522type%2522%253A%2522CommercePropTable%2522%252C%2522filter%2522%253A%257B%2522type%2522%253A%2522identity%2522%252C%2522params%2522%253A%255B%255D%257D%252C%2522dataPath%2522%253A%2522database.commerceOrder.userItems%255B%255D.product.f_sku_properties_3dr%5B%5D%2522%257D%257D%252C%257B%2522optionValues%2522%253A%257B%2522type%2522%253A%2522CommercePropValues%2522%252C%2522filter%2522%253A%257B%2522type%2522%253A%2522identity%2522%252C%2522params%2522%253A%255B%255D%257D%252C%2522dataPath%2522%253A%2522database.commerceOrder.userItems%255B%255D.sku.f_sku_values_3dr%2522%257D%257D%255D%22%20class%3D%22w-commerce-commercecartoptionlist%22%20data-wf-collection%3D%22database.commerceOrder.userItems%255B%255D.product.f_sku_properties_3dr%22%20data-wf-template-id%3D%22wf-template-2c76bc54-c15b-04bf-e5e8-b75141368806%22%3E%3Cli%3E%3Cspan%20data-wf-bindings%3D%22%255B%257B%2522innerHTML%2522%253A%257B%2522type%2522%253A%2522PlainText%2522%252C%2522filter%2522%253A%257B%2522type%2522%253A%2522identity%2522%252C%2522params%2522%253A%255B%255D%257D%252C%2522dataPath%2522%253A%2522database.commerceOrder.userItems%255B%255D.product.f_sku_properties_3dr%255B%255D.name%2522%257D%257D%255D%22%20class%3D%22w-dyn-bind-empty%22%3E%3C%2Fspan%3E%3Cspan%3E%3A%20%3C%2Fspan%3E%3Cspan%20data-wf-bindings%3D%22%255B%257B%2522innerHTML%2522%253A%257B%2522type%2522%253A%2522CommercePropValues%2522%252C%2522filter%2522%253A%257B%2522type%2522%253A%2522identity%2522%252C%2522params%2522%253A%255B%255D%257D%252C%2522dataPath%2522%253A%2522database.commerceOrder.userItems%255B%255D.product.f_sku_properties_3dr%255B%255D%2522%257D%257D%255D%22%20class%3D%22w-dyn-bind-empty%22%3E%3C%2Fspan%3E%3C%2Fli%3E%3C%2Ful%3E%3Ca%20href%3D%22%23%22%20data-wf-bindings%3D%22%255B%257B%2522data-commerce-sku-id%2522%253A%257B%2522type%2522%253A%2522ItemRef%2522%252C%2522filter%2522%253A%257B%2522type%2522%253A%2522identity%2522%252C%2522params%2522%253A%255B%255D%257D%252C%2522dataPath%2522%253A%2522database.commerceOrder.userItems%255B%255D.sku.id%2522%257D%257D%255D%22%20class%3D%22w-inline-block%22%20data-wf-cart-action%3D%22remove-item%22%20data-commerce-sku-id%3D%22%22%3E%3Cdiv%3ERemove%3C%2Fdiv%3E%3C%2Fa%3E%3C%2Fdiv%3E%3Cinput%20type%3D%22number%22%20data-wf-bindings%3D%22%255B%257B%2522value%2522%253A%257B%2522type%2522%253A%2522Number%2522%252C%2522filter%2522%253A%257B%2522type%2522%253A%2522numberPrecision%2522%252C%2522params%2522%253A%255B%25220%2522%252C%2522numberPrecision%2522%255D%257D%252C%2522dataPath%2522%253A%2522database.commerceOrder.userItems%255B%255D.count%2522%257D%257D%252C%257B%2522data-commerce-sku-id%2522%253A%257B%2522type%2522%253A%2522ItemRef%2522%252C%2522filter%2522%253A%257B%2522type%2522%253A%2522identity%2522%252C%2522params%2522%253A%255B%255D%257D%252C%2522dataPath%2522%253A%2522database.commerceOrder.userItems%255B%255D.sku.id%2522%257D%257D%255D%22%20class%3D%22w-commerce-commercecartquantity%20input%22%20required%3D%22%22%20pattern%3D%22%5E%5B0-9%5D%2B%24%22%20inputMode%3D%22numeric%22%20name%3D%22quantity%22%20autoComplete%3D%22off%22%20data-wf-cart-action%3D%22update-item-quantity%22%20data-commerce-sku-id%3D%22%22%20value%3D%221%22%2F%3E%3C%2Fdiv%3E</script>
                                <div class="w-commerce-commercecartlist cart-list"
                                     data-wf-collection="database.commerceOrder.userItems"
                                     data-wf-template-id="wf-template-2c76bc54-c15b-04bf-e5e8-b75141368800">
                                    <div class="w-commerce-commercecartitem"><a
                                            data-wf-bindings="%5B%7B%22dataWHref%22%3A%7B%22type%22%3A%22PlainText%22%2C%22filter%22%3A%7B%22type%22%3A%22detailPage%22%2C%22params%22%3A%5B%225eeac0d6a317b70070037afb%22%5D%7D%2C%22dataPath%22%3A%22database.commerceOrder.userItems%5B%5D.product.f_slug_%22%2C%22collectionSlugMap%22%3A%7B%22COMMERCE_CART_COLLECTION_ID%22%3A%22cart%22%2C%225ec968d7d0fb9b3992a6555b%22%3A%22blog-category%22%2C%225ec9695e8d949f0627c6805b%22%3A%22author%22%2C%225ec724b60a860f0e046830ea%22%3A%22job-category%22%2C%225ec722b32d8f477d090a77b7%22%3A%22job%22%2C%225eeac0d6a317b7174d037afc%22%3A%22sku%22%2C%225eeac0d6a317b714a7037afa%22%3A%22category%22%2C%225ec968bf06d25cb56010b11b%22%3A%22blog%22%2C%225eeac0d6a317b70070037afb%22%3A%22product%22%2C%225ec723a93fc8c015b347a355%22%3A%22company%22%2C%22COMMERCE_ORDER_USER_ITEMS_COLLECTION_ID%22%3A%22userItems%22%7D%7D%7D%5D"
                                            href="#" class="w-inline-block"><img
                                                data-wf-bindings="%5B%7B%22src%22%3A%7B%22type%22%3A%22ImageRef%22%2C%22filter%22%3A%7B%22type%22%3A%22identity%22%2C%22params%22%3A%5B%5D%7D%2C%22dataPath%22%3A%22database.commerceOrder.userItems%5B%5D.product.f_job_icon_2_3dr8dr%22%7D%7D%5D"
                                                src="" alt=""
                                                class="w-commerce-commercecartitemimage w-dyn-bind-empty"/></a>
                                        <div class="w-commerce-commercecartiteminfo">
                                            <div
                                                data-wf-bindings="%5B%7B%22innerHTML%22%3A%7B%22type%22%3A%22PlainText%22%2C%22filter%22%3A%7B%22type%22%3A%22identity%22%2C%22params%22%3A%5B%5D%7D%2C%22dataPath%22%3A%22database.commerceOrder.userItems%5B%5D.product.f_name_%22%7D%7D%5D"
                                                class="w-commerce-commercecartproductname checkout-product-title w-dyn-bind-empty"></div>
                                            <div
                                                data-wf-bindings="%5B%7B%22innerHTML%22%3A%7B%22type%22%3A%22CommercePrice%22%2C%22filter%22%3A%7B%22type%22%3A%22price%22%2C%22params%22%3A%5B%5D%7D%2C%22dataPath%22%3A%22database.commerceOrder.userItems%5B%5D.price%22%7D%7D%5D">
                                                $ 0.00 USD
                                            </div>
                                            <script type="text/x-wf-template"
                                                    id="wf-template-2c76bc54-c15b-04bf-e5e8-b75141368806">%3Cli%3E%3Cspan%20data-wf-bindings%3D%22%255B%257B%2522innerHTML%2522%253A%257B%2522type%2522%253A%2522PlainText%2522%252C%2522filter%2522%253A%257B%2522type%2522%253A%2522identity%2522%252C%2522params%2522%253A%255B%255D%257D%252C%2522dataPath%2522%253A%2522database.commerceOrder.userItems%255B%255D.product.f_sku_properties_3dr%255B%255D.name%2522%257D%257D%255D%22%20class%3D%22w-dyn-bind-empty%22%3E%3C%2Fspan%3E%3Cspan%3E%3A%20%3C%2Fspan%3E%3Cspan%20data-wf-bindings%3D%22%255B%257B%2522innerHTML%2522%253A%257B%2522type%2522%253A%2522CommercePropValues%2522%252C%2522filter%2522%253A%257B%2522type%2522%253A%2522identity%2522%252C%2522params%2522%253A%255B%255D%257D%252C%2522dataPath%2522%253A%2522database.commerceOrder.userItems%255B%255D.product.f_sku_properties_3dr%255B%255D%2522%257D%257D%255D%22%20class%3D%22w-dyn-bind-empty%22%3E%3C%2Fspan%3E%3C%2Fli%3E</script>
                                            <ul data-wf-bindings="%5B%7B%22optionSets%22%3A%7B%22type%22%3A%22CommercePropTable%22%2C%22filter%22%3A%7B%22type%22%3A%22identity%22%2C%22params%22%3A%5B%5D%7D%2C%22dataPath%22%3A%22database.commerceOrder.userItems%5B%5D.product.f_sku_properties_3dr[]%22%7D%7D%2C%7B%22optionValues%22%3A%7B%22type%22%3A%22CommercePropValues%22%2C%22filter%22%3A%7B%22type%22%3A%22identity%22%2C%22params%22%3A%5B%5D%7D%2C%22dataPath%22%3A%22database.commerceOrder.userItems%5B%5D.sku.f_sku_values_3dr%22%7D%7D%5D"
                                                class="w-commerce-commercecartoptionlist"
                                                data-wf-collection="database.commerceOrder.userItems%5B%5D.product.f_sku_properties_3dr"
                                                data-wf-template-id="wf-template-2c76bc54-c15b-04bf-e5e8-b75141368806">
                                                <li><span
                                                        data-wf-bindings="%5B%7B%22innerHTML%22%3A%7B%22type%22%3A%22PlainText%22%2C%22filter%22%3A%7B%22type%22%3A%22identity%22%2C%22params%22%3A%5B%5D%7D%2C%22dataPath%22%3A%22database.commerceOrder.userItems%5B%5D.product.f_sku_properties_3dr%5B%5D.name%22%7D%7D%5D"
                                                        class="w-dyn-bind-empty"></span><span>: </span><span
                                                        data-wf-bindings="%5B%7B%22innerHTML%22%3A%7B%22type%22%3A%22CommercePropValues%22%2C%22filter%22%3A%7B%22type%22%3A%22identity%22%2C%22params%22%3A%5B%5D%7D%2C%22dataPath%22%3A%22database.commerceOrder.userItems%5B%5D.product.f_sku_properties_3dr%5B%5D%22%7D%7D%5D"
                                                        class="w-dyn-bind-empty"></span></li>
                                            </ul>
                                            <a href="#"
                                               data-wf-bindings="%5B%7B%22data-commerce-sku-id%22%3A%7B%22type%22%3A%22ItemRef%22%2C%22filter%22%3A%7B%22type%22%3A%22identity%22%2C%22params%22%3A%5B%5D%7D%2C%22dataPath%22%3A%22database.commerceOrder.userItems%5B%5D.sku.id%22%7D%7D%5D"
                                               class="w-inline-block" data-wf-cart-action="remove-item"
                                               data-commerce-sku-id="">
                                                <div>Remove</div>
                                            </a></div>
                                        <input type="number"
                                               data-wf-bindings="%5B%7B%22value%22%3A%7B%22type%22%3A%22Number%22%2C%22filter%22%3A%7B%22type%22%3A%22numberPrecision%22%2C%22params%22%3A%5B%220%22%2C%22numberPrecision%22%5D%7D%2C%22dataPath%22%3A%22database.commerceOrder.userItems%5B%5D.count%22%7D%7D%2C%7B%22data-commerce-sku-id%22%3A%7B%22type%22%3A%22ItemRef%22%2C%22filter%22%3A%7B%22type%22%3A%22identity%22%2C%22params%22%3A%5B%5D%7D%2C%22dataPath%22%3A%22database.commerceOrder.userItems%5B%5D.sku.id%22%7D%7D%5D"
                                               class="w-commerce-commercecartquantity input" required=""
                                               pattern="^[0-9]+$" inputMode="numeric" name="quantity" autoComplete="off"
                                               data-wf-cart-action="update-item-quantity" data-commerce-sku-id=""
                                               value="1"/></div>
                                </div>
                                <div class="w-commerce-commercecartfooter">
                                    <div class="w-commerce-commercecartlineitem">
                                        <div>Subtotal</div>
                                        <div
                                            data-wf-bindings="%5B%7B%22innerHTML%22%3A%7B%22type%22%3A%22CommercePrice%22%2C%22filter%22%3A%7B%22type%22%3A%22price%22%2C%22params%22%3A%5B%5D%7D%2C%22dataPath%22%3A%22database.commerceOrder.subtotal%22%7D%7D%5D"
                                            class="w-commerce-commercecartordervalue subtotal-price"></div>
                                    </div>
                                    <div><a href="/checkout" value="Continue to Checkout"
                                            data-node-type="cart-checkout-button"
                                            class="w-commerce-commercecartcheckoutbutton button-primary large"
                                            data-loading-text="Hang Tight...">Continue to Checkout</a></div>
                                </div>
                            </form>
                            <div class="w-commerce-commercecartemptystate empty-state-cart">
                                <div class="cart-empty-text">You haven&#x27;t added any job, please browse our options
                                </div>
                                <a href="/featured-jobs" class="button-primary w-button">View Options</a></div>
                            <div style="display:none" data-node-type="commerce-cart-error"
                                 class="w-commerce-commercecarterrorstate error-message">
                                <div class="w-cart-error-msg"
                                     data-w-cart-quantity-error="There&#x27;s been an error with your cart."
                                     data-w-cart-general-error="Something went wrong when adding this item to the cart."
                                     data-w-cart-checkout-error="Checkout is disabled on this site."
                                     data-w-cart-cart_order_min-error="The order minimum was not met. Add more items to your cart to continue."
                                     data-w-cart-subscription_error-error="Before you purchase, please use your email invite to verify your address so we can send order updates.">
                                    There&#x27;s been an error with your cart.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section short wf-section">
        <div class="container-default">
            <div class="flex space-between-center"><h1 data-w-id="b285650b-5ee0-77f6-8145-88aa1adb9515"
                                                       style="-webkit-transform:translate3d(0, 100PX, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 100PX, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 100PX, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 100PX, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0"
                                                       class="title-jobs">Latest <span
                        class="color-primary-1 underline">Tech Jobs</span></h1>
                <div class="button-mg"><a data-w-id="b285650b-5ee0-77f6-8145-88aa1adb951a" style="opacity:0"
                                          href="/pricing" class="button-primary w-button">Post a Job</a></div>
            </div>
            <div class="w-layout-grid grid-jobs">
                <div data-w-id="b285650b-5ee0-77f6-8145-88aa1adb951d" style="opacity:0">
                    <div class="w-dyn-list">
                        <div role="list" class="job-cards-grid w-dyn-items">
                            <div role="listitem" class="w-dyn-item">
                                <div class="job-post-card"><a href="/job/digital-marketing-specialist"
                                                              class="w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/5ec7544ec6c12cc69e23ebae_webflow-logo.svg"
                                            alt="Digital Marketing Specialist" class="company-logo job-card"/></a>
                                    <div class="job-card-info">
                                        <div class="job-info-primary"><a href="/company/webflow"
                                                                         class="job-card-company-name w-inline-block">
                                                <div>Webflow</div>
                                            </a><a href="/job/digital-marketing-specialist"
                                                   class="job-card-title-link w-inline-block"><h2
                                                    class="job-card-title h3-size">Digital Marketing Specialist</h2></a>
                                            <div class="job-card-info-bottom"><a href="/job-category/marketing"
                                                                                 class="job-badge card">Marketing</a>
                                                <div class="job-card-type-container"><img
                                                        src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec73e88c56a5287efe5d63a_job-type-icon.svg"
                                                        alt="" class="job-card-type-icon"/>
                                                    <div class="job-card-type-text">Full Time</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-info-secondary">
                                            <div class="featured-badge">Featured</div>
                                            <div class="job-card-spacer w-condition-invisible"></div>
                                            <div class="job-card-date">April 7, 2021</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="job-post-card"><a href="/job/senior-software-developer"
                                                              class="w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/5ec754549ef05a7f4cb069ac_facebook-logo.svg"
                                            alt="Senior Software Developer" class="company-logo job-card"/></a>
                                    <div class="job-card-info">
                                        <div class="job-info-primary"><a href="/company/facebook"
                                                                         class="job-card-company-name w-inline-block">
                                                <div>Facebook</div>
                                            </a><a href="/job/senior-software-developer"
                                                   class="job-card-title-link w-inline-block"><h2
                                                    class="job-card-title h3-size">Senior Software Developer</h2></a>
                                            <div class="job-card-info-bottom"><a href="/job-category/development"
                                                                                 class="job-badge card">Development</a>
                                                <div class="job-card-type-container"><img
                                                        src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec73e88c56a5287efe5d63a_job-type-icon.svg"
                                                        alt="" class="job-card-type-icon"/>
                                                    <div class="job-card-type-text">Full Time</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-info-secondary">
                                            <div class="featured-badge w-condition-invisible">Featured</div>
                                            <div class="job-card-spacer"></div>
                                            <div class="job-card-date">April 7, 2021</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="job-post-card"><a href="/job/junior-support-specialist"
                                                              class="w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/5ec7545e4d807cad68dce185_twitter-logo.svg"
                                            alt="Junior Support Specialist" class="company-logo job-card"/></a>
                                    <div class="job-card-info">
                                        <div class="job-info-primary"><a href="/company/twitter"
                                                                         class="job-card-company-name w-inline-block">
                                                <div>Twitter</div>
                                            </a><a href="/job/junior-support-specialist"
                                                   class="job-card-title-link w-inline-block"><h2
                                                    class="job-card-title h3-size">Junior Support Specialist</h2></a>
                                            <div class="job-card-info-bottom"><a href="/job-category/support"
                                                                                 class="job-badge card">Support</a>
                                                <div class="job-card-type-container"><img
                                                        src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec73e88c56a5287efe5d63a_job-type-icon.svg"
                                                        alt="" class="job-card-type-icon"/>
                                                    <div class="job-card-type-text">Full Time</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-info-secondary">
                                            <div class="featured-badge">Featured</div>
                                            <div class="job-card-spacer w-condition-invisible"></div>
                                            <div class="job-card-date">April 7, 2021</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="job-post-card"><a href="/job/director-of-strategic-success"
                                                              class="w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/5ec7546c1268675fb1597e65_google-logo.svg"
                                            alt="Director of Strategic Success" class="company-logo job-card"/></a>
                                    <div class="job-card-info">
                                        <div class="job-info-primary"><a href="/company/google"
                                                                         class="job-card-company-name w-inline-block">
                                                <div>Google</div>
                                            </a><a href="/job/director-of-strategic-success"
                                                   class="job-card-title-link w-inline-block"><h2
                                                    class="job-card-title h3-size">Director of Strategic Success</h2>
                                            </a>
                                            <div class="job-card-info-bottom"><a href="/job-category/business"
                                                                                 class="job-badge card">Business</a>
                                                <div class="job-card-type-container"><img
                                                        src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec73e88c56a5287efe5d63a_job-type-icon.svg"
                                                        alt="" class="job-card-type-icon"/>
                                                    <div class="job-card-type-text">Part Time</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-info-secondary">
                                            <div class="featured-badge w-condition-invisible">Featured</div>
                                            <div class="job-card-spacer"></div>
                                            <div class="job-card-date">April 7, 2021</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="job-post-card"><a href="/job/senior-product-designer"
                                                              class="w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/601e0ae38e04ef29e8e0e3cc_youtube-jobs-webflow-template.svg"
                                            alt="Senior Product Designer" class="company-logo job-card"/></a>
                                    <div class="job-card-info">
                                        <div class="job-info-primary"><a href="/company/youtube"
                                                                         class="job-card-company-name w-inline-block">
                                                <div>YouTube</div>
                                            </a><a href="/job/senior-product-designer"
                                                   class="job-card-title-link w-inline-block"><h2
                                                    class="job-card-title h3-size">Senior Product Designer</h2></a>
                                            <div class="job-card-info-bottom"><a href="/job-category/design"
                                                                                 class="job-badge card">Design</a>
                                                <div class="job-card-type-container"><img
                                                        src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec73e88c56a5287efe5d63a_job-type-icon.svg"
                                                        alt="" class="job-card-type-icon"/>
                                                    <div class="job-card-type-text">Full Time</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-info-secondary">
                                            <div class="featured-badge w-condition-invisible">Featured</div>
                                            <div class="job-card-spacer"></div>
                                            <div class="job-card-date">April 7, 2021</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="job-post-card"><a href="/job/customer-support-specialist"
                                                              class="w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/5ecbf8dd22f3206e7c99c96d_instagram-logo.svg"
                                            alt="Customer Support Specialist" class="company-logo job-card"/></a>
                                    <div class="job-card-info">
                                        <div class="job-info-primary"><a href="/company/instagram"
                                                                         class="job-card-company-name w-inline-block">
                                                <div>Instagram</div>
                                            </a><a href="/job/customer-support-specialist"
                                                   class="job-card-title-link w-inline-block"><h2
                                                    class="job-card-title h3-size">Customer Support Specialist</h2></a>
                                            <div class="job-card-info-bottom"><a href="/job-category/support"
                                                                                 class="job-badge card">Support</a>
                                                <div class="job-card-type-container"><img
                                                        src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec73e88c56a5287efe5d63a_job-type-icon.svg"
                                                        alt="" class="job-card-type-icon"/>
                                                    <div class="job-card-type-text">Full Time</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-info-secondary">
                                            <div class="featured-badge w-condition-invisible">Featured</div>
                                            <div class="job-card-spacer"></div>
                                            <div class="job-card-date">April 7, 2021</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="job-post-card"><a href="/job/front-end-web-developer"
                                                              class="w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/601e0ae38e04ef29e8e0e3cc_youtube-jobs-webflow-template.svg"
                                            alt="Front End Web Developer" class="company-logo job-card"/></a>
                                    <div class="job-card-info">
                                        <div class="job-info-primary"><a href="/company/youtube"
                                                                         class="job-card-company-name w-inline-block">
                                                <div>YouTube</div>
                                            </a><a href="/job/front-end-web-developer"
                                                   class="job-card-title-link w-inline-block"><h2
                                                    class="job-card-title h3-size">Front End Web Developer</h2></a>
                                            <div class="job-card-info-bottom"><a href="/job-category/development"
                                                                                 class="job-badge card">Development</a>
                                                <div class="job-card-type-container"><img
                                                        src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec73e88c56a5287efe5d63a_job-type-icon.svg"
                                                        alt="" class="job-card-type-icon"/>
                                                    <div class="job-card-type-text">Freelance</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-info-secondary">
                                            <div class="featured-badge w-condition-invisible">Featured</div>
                                            <div class="job-card-spacer"></div>
                                            <div class="job-card-date">April 7, 2021</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="job-post-card"><a href="/job/technical-project-manager"
                                                              class="w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/5ec7544ec6c12cc69e23ebae_webflow-logo.svg"
                                            alt="Technical Project Manager" class="company-logo job-card"/></a>
                                    <div class="job-card-info">
                                        <div class="job-info-primary"><a href="/company/webflow"
                                                                         class="job-card-company-name w-inline-block">
                                                <div>Webflow</div>
                                            </a><a href="/job/technical-project-manager"
                                                   class="job-card-title-link w-inline-block"><h2
                                                    class="job-card-title h3-size">Technical Project Manager</h2></a>
                                            <div class="job-card-info-bottom"><a href="/job-category/business"
                                                                                 class="job-badge card">Business</a>
                                                <div class="job-card-type-container"><img
                                                        src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec73e88c56a5287efe5d63a_job-type-icon.svg"
                                                        alt="" class="job-card-type-icon"/>
                                                    <div class="job-card-type-text">Full Time</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-info-secondary">
                                            <div class="featured-badge w-condition-invisible">Featured</div>
                                            <div class="job-card-spacer"></div>
                                            <div class="job-card-date">April 7, 2021</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="listitem" class="w-dyn-item">
                                <div class="job-post-card"><a href="/job/product-ux-researcher"
                                                              class="w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/5ec7544ec6c12cc69e23ebae_webflow-logo.svg"
                                            alt="Product UX Researcher" class="company-logo job-card"/></a>
                                    <div class="job-card-info">
                                        <div class="job-info-primary"><a href="/company/webflow"
                                                                         class="job-card-company-name w-inline-block">
                                                <div>Webflow</div>
                                            </a><a href="/job/product-ux-researcher"
                                                   class="job-card-title-link w-inline-block"><h2
                                                    class="job-card-title h3-size">Product UX Researcher</h2></a>
                                            <div class="job-card-info-bottom"><a href="/job-category/design"
                                                                                 class="job-badge card">Design</a>
                                                <div class="job-card-type-container"><img
                                                        src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec73e88c56a5287efe5d63a_job-type-icon.svg"
                                                        alt="" class="job-card-type-icon"/>
                                                    <div class="job-card-type-text">Part Time</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-info-secondary">
                                            <div class="featured-badge">Featured</div>
                                            <div class="job-card-spacer w-condition-invisible"></div>
                                            <div class="job-card-date">April 7, 2021</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="navigation" aria-label="List" class="w-pagination-wrapper pagination-container"><a
                                href="?1adb951e_page=2" aria-label="Next Page" class="w-pagination-next button-primary">
                                <div class="w-inline-block">Next</div>
                            </a>
                            <link rel="prerender" href="?1adb951e_page=2"/>
                        </div>
                    </div>
                </div>
                <aside data-w-id="30d385e6-0988-f484-1156-8e7aabda315c" class="sidebar-jobs">
                    <div id="w-node-_30d385e6-0988-f484-1156-8e7aabda315d-abda315c" class="sidebar-search"><h3
                            class="sidebar-title">Search jobs</h3>
                        <form action="/search" class="search-container sidebar w-form"><input type="search"
                                                                                              class="search-input sidebar w-input"
                                                                                              maxlength="256"
                                                                                              name="query"
                                                                                              placeholder="Search for jobs"
                                                                                              id="search"
                                                                                              required=""/><input
                                type="submit" value="Search Job" class="button-primary search sidebar w-button"/></form>
                    </div>
                    <div id="w-node-_30d385e6-0988-f484-1156-8e7aabda3163-abda315c" class="card sidebar"><h3
                            class="sidebar-title">Categories</h3>
                        <div class="w-dyn-list">
                            <div role="list" class="sidebar-menu-grid w-dyn-items">
                                <div role="listitem" class="sidebar-menu w-dyn-item"><a
                                        data-w-id="30d385e6-0988-f484-1156-8e7aabda3169"
                                        href="/job-category/development"
                                        class="sidebar-menu-link category w-inline-block">
                                        <div class="flex"><img
                                                src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/5ecf33bb9d8fbe8246dea6b4_development-icon.svg"
                                                alt="Development" class="sidebar-category-icon"/>
                                            <div>Development</div>
                                        </div>
                                        <img
                                            src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec72b55e6f629e9e925976b_arrow-blue.svg"
                                            alt="" class="arrow-category"/></a></div>
                                <div role="listitem" class="sidebar-menu w-dyn-item"><a
                                        data-w-id="30d385e6-0988-f484-1156-8e7aabda3169" href="/job-category/design"
                                        class="sidebar-menu-link category w-inline-block">
                                        <div class="flex"><img
                                                src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/5ecf33b725d6029893f7973b_design-icon.svg"
                                                alt="Design" class="sidebar-category-icon"/>
                                            <div>Design</div>
                                        </div>
                                        <img
                                            src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec72b55e6f629e9e925976b_arrow-blue.svg"
                                            alt="" class="arrow-category"/></a></div>
                                <div role="listitem" class="sidebar-menu w-dyn-item"><a
                                        data-w-id="30d385e6-0988-f484-1156-8e7aabda3169" href="/job-category/marketing"
                                        class="sidebar-menu-link category w-inline-block">
                                        <div class="flex"><img
                                                src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/5ecf33b335aad5162a980f28_marketing-icon.svg"
                                                alt="Marketing" class="sidebar-category-icon"/>
                                            <div>Marketing</div>
                                        </div>
                                        <img
                                            src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec72b55e6f629e9e925976b_arrow-blue.svg"
                                            alt="" class="arrow-category"/></a></div>
                                <div role="listitem" class="sidebar-menu w-dyn-item"><a
                                        data-w-id="30d385e6-0988-f484-1156-8e7aabda3169" href="/job-category/business"
                                        class="sidebar-menu-link category w-inline-block">
                                        <div class="flex"><img
                                                src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/5ecf33ae8d34e7d891e49239_business-icon.svg"
                                                alt="Business" class="sidebar-category-icon"/>
                                            <div>Business</div>
                                        </div>
                                        <img
                                            src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec72b55e6f629e9e925976b_arrow-blue.svg"
                                            alt="" class="arrow-category"/></a></div>
                                <div role="listitem" class="sidebar-menu w-dyn-item"><a
                                        data-w-id="30d385e6-0988-f484-1156-8e7aabda3169" href="/job-category/support"
                                        class="sidebar-menu-link category w-inline-block">
                                        <div class="flex"><img
                                                src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/5ecf33aa64d3018ba05ddbd7_support-icon.svg"
                                                alt="Support" class="sidebar-category-icon"/>
                                            <div>Support</div>
                                        </div>
                                        <img
                                            src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec72b55e6f629e9e925976b_arrow-blue.svg"
                                            alt="" class="arrow-category"/></a></div>
                            </div>
                        </div>
                    </div>
                    <div id="w-node-_30d385e6-0988-f484-1156-8e7aabda3171-abda315c" class="card sidebar"><h3
                            class="sidebar-title">Featured Companies</h3>
                        <div class="w-dyn-list">
                            <div role="list" class="companies-sidebar-grid w-dyn-items">
                                <div role="listitem" class="w-dyn-item"><a
                                        data-w-id="30d385e6-0988-f484-1156-8e7aabda3177" href="/company/facebook"
                                        class="company-link-wrapper w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/5ec754549ef05a7f4cb069ac_facebook-logo.svg"
                                            alt="Facebook" class="company-logo sidebar"/>
                                        <div>
                                            <div class="company-name">Facebook</div>
                                            <div class="compnay-industry">Social Network</div>
                                        </div>
                                    </a></div>
                                <div role="listitem" class="w-dyn-item"><a
                                        data-w-id="30d385e6-0988-f484-1156-8e7aabda3177" href="/company/twitter"
                                        class="company-link-wrapper w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/5ec7545e4d807cad68dce185_twitter-logo.svg"
                                            alt="Twitter" class="company-logo sidebar"/>
                                        <div>
                                            <div class="company-name">Twitter</div>
                                            <div class="compnay-industry">Social Network</div>
                                        </div>
                                    </a></div>
                                <div role="listitem" class="w-dyn-item"><a
                                        data-w-id="30d385e6-0988-f484-1156-8e7aabda3177" href="/company/instagram"
                                        class="company-link-wrapper w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/5ecbf8dd22f3206e7c99c96d_instagram-logo.svg"
                                            alt="Instagram" class="company-logo sidebar"/>
                                        <div>
                                            <div class="company-name">Instagram</div>
                                            <div class="compnay-industry">Social Media</div>
                                        </div>
                                    </a></div>
                                <div role="listitem" class="w-dyn-item"><a
                                        data-w-id="30d385e6-0988-f484-1156-8e7aabda3177" href="/company/messenger"
                                        class="company-link-wrapper w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f27e60d6355/601e0ad851182b272f1fff3c_messenger-jobs-webflow-template.svg"
                                            alt="Messenger" class="company-logo sidebar"/>
                                        <div>
                                            <div class="company-name">Messenger</div>
                                            <div class="compnay-industry">Automatization</div>
                                        </div>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
    <div class="banner-container wf-section">
        <div class="container-default">
            <div class="w-layout-grid banner-grid">
                <div class="banner-text-container"><h2 data-w-id="47f277ab-d097-d76d-6d24-e54ac0d39dee"
                                                       class="banner-title">Find your next<br/>great opportunity!</h2>
                    <p data-w-id="47f277ab-d097-d76d-6d24-e54ac0d39df2" class="paragraph-large banner">Join our
                        newsletter and receive the best job openings every week on your inbox.</p></div>
                <div data-w-id="47f277ab-d097-d76d-6d24-e54ac0d39df4">
                    <div class="w-form">
                        <form id="email-form" name="email-form" data-name="Email Form" method="get"
                              class="subscribe-form-container"><input type="email" class="subscribe-input w-input"
                                                                      maxlength="256" name="email-2" data-name="Email 2"
                                                                      placeholder="Enter your email" id="email-2"
                                                                      required=""/><input type="submit"
                                                                                          value="Subscribe"
                                                                                          data-wait="Please wait..."
                                                                                          class="button-primary banner-form w-button"/>
                        </form>
                        <div class="success-dark w-form-done">
                            <div>Thank you for subscribing to our newsletter!<br/></div>
                        </div>
                        <div class="error-dark w-form-fail">
                            <div>Oops! Something went wrong.</div>
                        </div>
                    </div>
                    <div class="banner-sub-form-text">Join 15,000+ users already on the newsletter!</div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-default footer-container">
            <div class="w-layout-grid footer-grid">
                <div data-w-id="3d726284-f6bb-3a12-f81e-5f8e3874b8e7"><h3 class="footer-title">Find your next great
                        opportunity!</h3>
                    <p>Join our newsletter and receive the best job openings every week on your inbox.</p>
                    <div class="w-form">
                        <form id="email-form" name="email-form" data-name="Email Form" method="get"
                              class="subscribe-form-container"><input type="email"
                                                                      class="subscribe-input white-input w-input"
                                                                      maxlength="256" name="Email" data-name="Email"
                                                                      placeholder="Enter your email" id="Email-3"
                                                                      required=""/><input type="submit"
                                                                                          value="Subscribe"
                                                                                          data-wait="Please wait..."
                                                                                          class="button-primary banner-form white-bg w-button"/>
                        </form>
                        <div class="success-white w-form-done">
                            <div>Thank you for subscribing to our newsletter!<br/></div>
                        </div>
                        <div class="error-white w-form-fail">
                            <div>Oops! Something went wrong.</div>
                        </div>
                    </div>
                </div>
                <div>
                    <div data-w-id="6664d1ce-10c1-caea-a340-642053fcd291" class="w-layout-grid footer-grid-menu">
                        <div><h3 class="footer-title menu">Menu</h3>
                            <div class="_2-menus-footer">
                                <ul role="list" class="footer-menu-container right-menu">
                                    <li class="footer-link-wrapper"><a href="/" class="footer-link">Home Sales</a></li>
                                    <li class="footer-link-wrapper"><a href="/home-v1" class="footer-link">Home V1</a>
                                    </li>
                                    <li class="footer-link-wrapper"><a href="/home-v2" class="footer-link">Home V2</a>
                                    </li>
                                    <li class="footer-link-wrapper"><a href="/about-us" class="footer-link">About Us</a>
                                    </li>
                                </ul>
                                <ul role="list" class="footer-menu-container">
                                    <li class="footer-link-wrapper"><a href="/companies"
                                                                       class="footer-link">Companies</a></li>
                                    <li class="footer-link-wrapper"><a
                                            href="https://jobstemplate.webflow.io/company/webflow" class="footer-link">Companies
                                            Single</a></li>
                                    <li class="footer-link-wrapper"><a
                                            href="https://jobstemplate.webflow.io/job/customer-support-specialist"
                                            class="footer-link">Job Single</a></li>
                                </ul>
                            </div>
                        </div>
                        <div><h3 class="footer-title menu">Utility Pages</h3>
                            <ul role="list" class="footer-menu-container right-menu">
                                <li class="footer-link-wrapper"><a href="https://jobstemplate.webflow.io/401"
                                                                   class="footer-link">Password protected</a></li>
                                <li class="footer-link-wrapper"><a href="https://jobstemplate.webflow.io/404"
                                                                   class="footer-link">404 Not Found</a></li>
                                <li class="footer-link-wrapper"><a href="/utility-pages/styleguide" class="footer-link">Styleguide</a>
                                </li>
                                <li class="footer-link-wrapper"><a href="/utility-pages/licenses" class="footer-link">Licenses</a>
                                </li>
                                <li class="footer-link-wrapper"><a href="/utility-pages/start-here" class="footer-link">Start
                                        Here</a></li>
                                <li class="footer-link-wrapper"><a href="/utility-pages/changelog" class="footer-link">Changelog</a>
                                </li>
                                <li class="footer-link-wrapper"><a href="http://brixtemplates.com/more-templates"
                                                                   class="footer-link special">More webflow
                                        templates</a></li>
                            </ul>
                        </div>
                        <div><h3 class="footer-title menu">Categories</h3>
                            <div class="_2-menus-footer">
                                <ul role="list" class="footer-menu-container right-menu">
                                    <li class="footer-link-wrapper"><a
                                            href="https://jobstemplate.webflow.io/job-category/development"
                                            class="footer-link">Development</a></li>
                                    <li class="footer-link-wrapper"><a
                                            href="https://jobstemplate.webflow.io/job-category/marketing"
                                            class="footer-link">Marketing</a></li>
                                    <li class="footer-link-wrapper"><a
                                            href="https://jobstemplate.webflow.io/job-category/support"
                                            class="footer-link">Support</a></li>
                                </ul>
                                <ul role="list" class="footer-menu-container">
                                    <li class="footer-link-wrapper"><a
                                            href="https://jobstemplate.webflow.io/job-category/design"
                                            class="footer-link">Design</a></li>
                                    <li class="footer-link-wrapper"><a
                                            href="https://jobstemplate.webflow.io/job-category/business"
                                            class="footer-link">Business</a></li>
                                </ul>
                            </div>
                        </div>
                        <div><h3 class="footer-title menu">Follow Us</h3>
                            <ul role="list" class="footer-menu-container right-menu">
                                <li class="footer-link-wrapper"><a href="http://facebook.com/"
                                                                   class="social-media-link-footer w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec9826823eec548b3182923_facebook.svg"
                                            alt="Facebook Icon - Jobs Webflow Template" class="social-icon-foote"/>
                                        <div>Facebook</div>
                                    </a></li>
                                <li class="footer-link-wrapper"><a href="http://twitter.com/"
                                                                   class="social-media-link-footer w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec98269518a6e6118d567d1_twitter.svg"
                                            alt="Twitter - Jobs Webflow Template" class="social-icon-foote"/>
                                        <div>Twitter</div>
                                    </a></li>
                                <li class="footer-link-wrapper"><a href="http://instagram.com/"
                                                                   class="social-media-link-footer w-inline-block"><img
                                            src="https://assets.website-files.com/5ec5d86528da2f24250d634c/5ec982692fa1e9d0c1a8db49_instagram.svg"
                                            alt="Instagram - Jobs Webflow Template" class="social-icon-foote"/>
                                        <div>Instagram</div>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div data-w-id="43672ddb-3571-2ab6-380c-ff151fdf1f14" class="w-layout-grid copyright-grid"><a href="/"
                                                                                                          class="w-inline-block">
                <div class="text-block">© Copyright Jobs - Designed by <a href="https://brixtemplates.com/">BRIX
                        Templates</a> - Powered by <a href="http://webflow.com/">Webflow</a></div>
            </div>
        </div>
    </footer>
</div>

</html>
