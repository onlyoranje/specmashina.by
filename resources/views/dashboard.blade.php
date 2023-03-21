@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')


    <div class="section section-lg pt-5 pt-md-7 bg-gray-200">
        <div class="container">
            <div class="row pt-5 pt-md-0">
                @include('layouts.dashboard_profile')

                <div class="col-12 col-lg-8">
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-4">
                            <div class="card border-gray-300">
                                <div class="card-body d-block d-md-flex align-items-center">
                                    <div
                                        class="icon icon-shape icon-md icon-shape-primary rounded-circle me-3 mb-4 mb-md-0">
                                        <span class="fas fa-wallet"></span></div>
                                    <div><span class="d-block h6 fw-normal">Global Budget</span><h5
                                            class="h3 fw-bold mb-1">$25,370.00</h5>
                                        <div class="small mt-2"><span class="fas fa-angle-up text-success"></span> <span
                                                class="text-success fw-bold">18.2%</span> higher vs previous month
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mb-4">
                            <div class="card border-gray-300">
                                <div class="card-body d-block d-md-flex align-items-center">
                                    <div
                                        class="icon icon-shape icon-md icon-shape-primary rounded-circle me-3 mb-4 mb-md-0">
                                        <span class="fas fa-file-invoice-dollar"></span></div>
                                    <div><span class="d-block h6 fw-normal">Sales</span><h5 class="h3 fw-bold mb-1">
                                            $5,220.00</h5>
                                        <div class="small mt-2"><span class="fas fa-angle-up text-success"></span> <span
                                                class="text-success fw-bold">4.2%</span> higher vs previous month
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <div class="card border-gray-300">
                                <div class="card-body d-flex flex-row align-items-center flex-0 border-bottom">
                                    <div class="d-block">
                                        <div class="h6 fw-normal text-gray mb-2">New customers</div>
                                        <h2 class="h3">452</h2>
                                        <div class="small mt-2"><span class="fas fa-angle-up text-success"></span> <span
                                                class="text-success fw-bold">18.2%</span></div>
                                    </div>
                                    <div class="d-block ms-auto">
                                        <div class="d-flex align-items-center text-right mb-2"><span
                                                class="shape-xs rounded-circle bg-dark me-2"></span> <span
                                                class="fw-normal small">Last month</span></div>
                                        <div class="d-flex align-items-center text-right"><span
                                                class="shape-xs rounded-circle bg-tertiary me-2"></span> <span
                                                class="fw-normal small">This month</span></div>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <div class="ct-chart-5 ct-golden-section ct-series-e">
                                        <div class="chartist-tooltip" style="top: 41.625px; left: -37.8281px;"></div>
                                        <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%"
                                             height="100%" class="ct-chart-bar" style="width: 100%; height: 100%;">
                                            <g class="ct-grids">
                                                <line x1="10" x2="10" y1="15" y2="172.234375"
                                                      class="ct-grid ct-horizontal"></line>
                                                <line x1="54.332589285714285" x2="54.332589285714285" y1="15"
                                                      y2="172.234375" class="ct-grid ct-horizontal"></line>
                                                <line x1="98.66517857142857" x2="98.66517857142857" y1="15"
                                                      y2="172.234375" class="ct-grid ct-horizontal"></line>
                                                <line x1="142.99776785714286" x2="142.99776785714286" y1="15"
                                                      y2="172.234375" class="ct-grid ct-horizontal"></line>
                                                <line x1="187.33035714285714" x2="187.33035714285714" y1="15"
                                                      y2="172.234375" class="ct-grid ct-horizontal"></line>
                                                <line x1="231.66294642857142" x2="231.66294642857142" y1="15"
                                                      y2="172.234375" class="ct-grid ct-horizontal"></line>
                                                <line x1="275.9955357142857" x2="275.9955357142857" y1="15"
                                                      y2="172.234375" class="ct-grid ct-horizontal"></line>
                                            </g>
                                            <g>
                                                <g class="ct-series ct-series-a">
                                                    <line x1="24.66629464285714" x2="24.66629464285714" y1="172.234375"
                                                          y2="93.6171875" class="ct-bar" ct:value="5"></line>
                                                    <line x1="68.99888392857143" x2="68.99888392857143" y1="172.234375"
                                                          y2="109.340625" class="ct-bar" ct:value="4"></line>
                                                    <line x1="113.33147321428571" x2="113.33147321428571"
                                                          y1="172.234375" y2="125.0640625" class="ct-bar"
                                                          ct:value="3"></line>
                                                    <line x1="157.6640625" x2="157.6640625" y1="172.234375"
                                                          y2="62.170312499999994" class="ct-bar" ct:value="7"></line>
                                                    <line x1="201.99665178571428" x2="201.99665178571428"
                                                          y1="172.234375" y2="93.6171875" class="ct-bar"
                                                          ct:value="5"></line>
                                                    <line x1="246.32924107142856" x2="246.32924107142856"
                                                          y1="172.234375" y2="15" class="ct-bar" ct:value="10"></line>
                                                    <line x1="290.6618303571429" x2="290.6618303571429" y1="172.234375"
                                                          y2="125.0640625" class="ct-bar" ct:value="3"></line>
                                                </g>
                                                <g class="ct-series ct-series-b">
                                                    <line x1="39.66629464285714" x2="39.66629464285714" y1="172.234375"
                                                          y2="125.0640625" class="ct-bar" ct:value="3"></line>
                                                    <line x1="83.99888392857143" x2="83.99888392857143" y1="172.234375"
                                                          y2="140.7875" class="ct-bar" ct:value="2"></line>
                                                    <line x1="128.33147321428572" x2="128.33147321428572"
                                                          y1="172.234375" y2="30.72343749999999" class="ct-bar"
                                                          ct:value="9"></line>
                                                    <line x1="172.6640625" x2="172.6640625" y1="172.234375"
                                                          y2="93.6171875" class="ct-bar" ct:value="5"></line>
                                                    <line x1="216.99665178571428" x2="216.99665178571428"
                                                          y1="172.234375" y2="109.340625" class="ct-bar"
                                                          ct:value="4"></line>
                                                    <line x1="261.32924107142856" x2="261.32924107142856"
                                                          y1="172.234375" y2="77.89375" class="ct-bar"
                                                          ct:value="6"></line>
                                                    <line x1="305.6618303571429" x2="305.6618303571429" y1="172.234375"
                                                          y2="109.340625" class="ct-bar" ct:value="4"></line>
                                                </g>
                                            </g>
                                            <g class="ct-labels">
                                                <foreignObject style="overflow: visible;" x="10" y="177.234375"
                                                               width="44.332589285714285" height="20"><span
                                                        class="ct-label ct-horizontal ct-end"
                                                        xmlns="http://www.w3.org/2000/xmlns/"
                                                        style="width: 44px; height: 20px;">Mon</span></foreignObject>
                                                <foreignObject style="overflow: visible;" x="54.332589285714285"
                                                               y="177.234375" width="44.332589285714285" height="20">
                                                    <span class="ct-label ct-horizontal ct-end"
                                                          xmlns="http://www.w3.org/2000/xmlns/"
                                                          style="width: 44px; height: 20px;">Tue</span></foreignObject>
                                                <foreignObject style="overflow: visible;" x="98.66517857142857"
                                                               y="177.234375" width="44.33258928571429" height="20">
                                                    <span class="ct-label ct-horizontal ct-end"
                                                          xmlns="http://www.w3.org/2000/xmlns/"
                                                          style="width: 44px; height: 20px;">Wed</span></foreignObject>
                                                <foreignObject style="overflow: visible;" x="142.99776785714286"
                                                               y="177.234375" width="44.33258928571428" height="20">
                                                    <span class="ct-label ct-horizontal ct-end"
                                                          xmlns="http://www.w3.org/2000/xmlns/"
                                                          style="width: 44px; height: 20px;">Thu</span></foreignObject>
                                                <foreignObject style="overflow: visible;" x="187.33035714285714"
                                                               y="177.234375" width="44.33258928571428" height="20">
                                                    <span class="ct-label ct-horizontal ct-end"
                                                          xmlns="http://www.w3.org/2000/xmlns/"
                                                          style="width: 44px; height: 20px;">Fri</span></foreignObject>
                                                <foreignObject style="overflow: visible;" x="231.66294642857142"
                                                               y="177.234375" width="44.332589285714306" height="20">
                                                    <span class="ct-label ct-horizontal ct-end"
                                                          xmlns="http://www.w3.org/2000/xmlns/"
                                                          style="width: 44px; height: 20px;">Sat</span></foreignObject>
                                                <foreignObject style="overflow: visible;" x="275.9955357142857"
                                                               y="177.234375" width="44.33258928571428" height="20">
                                                    <span class="ct-label ct-horizontal ct-end"
                                                          xmlns="http://www.w3.org/2000/xmlns/"
                                                          style="width: 44px; height: 20px;">Sun</span></foreignObject>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <div class="card border-gray-300">
                                <div class="card-body d-flex flex-row align-items-center flex-0 border-bottom">
                                    <div class="d-block">
                                        <div class="h6 fw-normal text-gray mb-2">Revenues</div>
                                        <h2 class="h3">10,567</h2>
                                        <div class="small mt-2"><span class="fas fa-angle-up text-success"></span> <span
                                                class="text-success fw-bold">$10.57%</span></div>
                                    </div>
                                    <div class="d-block ms-auto">
                                        <div class="d-flex align-items-center text-right mb-2"><span
                                                class="shape-xs rounded-circle bg-dark me-2"></span> <span
                                                class="fw-normal small">Real Estate</span></div>
                                        <div class="d-flex align-items-center text-right mb-2"><span
                                                class="shape-xs rounded-circle bg-tertiary me-2"></span> <span
                                                class="fw-normal small">Electronic</span></div>
                                        <div class="d-flex align-items-center text-right mb-2"><span
                                                class="shape-xs rounded-circle bg-primary me-2"></span> <span
                                                class="fw-normal small">Clothes</span></div>
                                        <div class="d-flex align-items-center text-right"><span
                                                class="shape-xs rounded-circle bg-success me-2"></span> <span
                                                class="fw-normal small">Auto</span></div>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <div class="ct-chart-7 ct-golden-section ct-series-e">
                                        <div class="chartist-tooltip" style="top: 9.8125px; left: -32.1562px;"></div>
                                        <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%"
                                             height="100%" class="ct-chart-pie" style="width: 100%; height: 100%;">
                                            <g class="ct-series ct-series-a">
                                                <path
                                                    d="M261.455,134.092A98.617,98.617,0,0,0,167.664,5L167.664,103.617Z"
                                                    class="ct-slice-pie" ct:value="30"></path>
                                            </g>
                                            <g class="ct-series ct-series-b">
                                                <path
                                                    d="M73.874,134.092A98.617,98.617,0,0,0,261.56,133.764L167.664,103.617Z"
                                                    class="ct-slice-pie" ct:value="40"></path>
                                            </g>
                                            <g class="ct-series ct-series-c">
                                                <path
                                                    d="M73.874,73.143A98.617,98.617,0,0,0,73.98,134.419L167.664,103.617Z"
                                                    class="ct-slice-pie" ct:value="10"></path>
                                            </g>
                                            <g class="ct-series ct-series-d">
                                                <path d="M167.664,5A98.617,98.617,0,0,0,73.768,73.47L167.664,103.617Z"
                                                      class="ct-slice-pie" ct:value="20"></path>
                                            </g>
                                            <g>
                                                <text dx="207.55555281248033" dy="74.63432328246918"
                                                      text-anchor="middle" class="ct-label">30%
                                                </text>
                                                <text dx="167.6640625" dy="152.92578125" text-anchor="middle"
                                                      class="ct-label">40%
                                                </text>
                                                <text dx="118.35546875" dy="103.6171875" text-anchor="middle"
                                                      class="ct-label">10%
                                                </text>
                                                <text dx="138.68119828246918" dy="63.725697187519685"
                                                      text-anchor="middle" class="ct-label">20%
                                                </text>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="card border-gray-300">
                                <div class="card-body d-flex flex-row align-items-center flex-0 border-bottom">
                                    <div class="d-block">
                                        <div class="h6 fw-normal text-gray mb-2">Sales Value</div>
                                        <h2 class="h3">10,567</h2>
                                        <div class="small mt-2"><span class="fas fa-angle-up text-success"></span> <span
                                                class="text-success fw-bold">$10.57%</span></div>
                                    </div>
                                    <div class="d-flex ms-auto"><a href="#"
                                                                   class="btn btn-tertiary btn-sm me-3">Month</a> <a
                                            href="#" class="btn btn-white border-gray-300 btn-sm me-3">Week</a></div>
                                </div>
                                <div class="card-body p-2">
                                    <div class="ct-chart-8 ct-major-tenth ct-series-b">
                                        <div class="chartist-tooltip"></div>
                                        <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%"
                                             height="100%" class="ct-chart-line" style="width: 100%; height: 100%;">
                                            <g class="ct-grids">
                                                <line y1="250.0625" y2="250.0625" x1="50" x2="697.65625"
                                                      class="ct-grid ct-vertical"></line>
                                                <line y1="220.6796875" y2="220.6796875" x1="50" x2="697.65625"
                                                      class="ct-grid ct-vertical"></line>
                                                <line y1="191.296875" y2="191.296875" x1="50" x2="697.65625"
                                                      class="ct-grid ct-vertical"></line>
                                                <line y1="161.9140625" y2="161.9140625" x1="50" x2="697.65625"
                                                      class="ct-grid ct-vertical"></line>
                                                <line y1="132.53125" y2="132.53125" x1="50" x2="697.65625"
                                                      class="ct-grid ct-vertical"></line>
                                                <line y1="103.1484375" y2="103.1484375" x1="50" x2="697.65625"
                                                      class="ct-grid ct-vertical"></line>
                                                <line y1="73.765625" y2="73.765625" x1="50" x2="697.65625"
                                                      class="ct-grid ct-vertical"></line>
                                                <line y1="44.3828125" y2="44.3828125" x1="50" x2="697.65625"
                                                      class="ct-grid ct-vertical"></line>
                                                <line y1="15" y2="15" x1="50" x2="697.65625"
                                                      class="ct-grid ct-vertical"></line>
                                            </g>
                                            <g>
                                                <g class="ct-series ct-series-a">
                                                    <path
                                                        d="M50,250.063L50,250.063C85.981,230.474,121.962,217.415,157.943,191.297C193.924,165.179,229.905,73.766,265.885,73.766C301.866,73.766,337.847,132.531,373.828,132.531C409.809,132.531,445.79,15,481.771,15C517.752,15,553.733,54.177,589.714,73.766C625.694,93.354,661.675,112.943,697.656,132.531L697.656,250.063Z"
                                                        class="ct-area"></path>
                                                    <path
                                                        d="M50,250.063C85.981,230.474,121.962,217.415,157.943,191.297C193.924,165.179,229.905,73.766,265.885,73.766C301.866,73.766,337.847,132.531,373.828,132.531C409.809,132.531,445.79,15,481.771,15C517.752,15,553.733,54.177,589.714,73.766C625.694,93.354,661.675,112.943,697.656,132.531"
                                                        class="ct-line"></path>
                                                    <line x1="50" y1="250.0625" x2="50.01" y2="250.0625"
                                                          class="ct-point" ct:value="0"></line>
                                                    <line x1="157.94270833333331" y1="191.296875" x2="157.9527083333333"
                                                          y2="191.296875" class="ct-point" ct:value="10"></line>
                                                    <line x1="265.88541666666663" y1="73.765625" x2="265.8954166666666"
                                                          y2="73.765625" class="ct-point" ct:value="30"></line>
                                                    <line x1="373.828125" y1="132.53125" x2="373.838125" y2="132.53125"
                                                          class="ct-point" ct:value="20"></line>
                                                    <line x1="481.7708333333333" y1="15" x2="481.7808333333333" y2="15"
                                                          class="ct-point" ct:value="40"></line>
                                                    <line x1="589.7135416666666" y1="73.765625" x2="589.7235416666666"
                                                          y2="73.765625" class="ct-point" ct:value="30"></line>
                                                    <line x1="697.65625" y1="132.53125" x2="697.66625" y2="132.53125"
                                                          class="ct-point" ct:value="20"></line>
                                                </g>
                                            </g>
                                            <g class="ct-labels">
                                                <foreignObject style="overflow: visible;" x="50" y="255.0625"
                                                               width="107.94270833333333" height="20"><span
                                                        class="ct-label ct-horizontal ct-end"
                                                        xmlns="http://www.w3.org/2000/xmlns/"
                                                        style="width: 108px; height: 20px;">Mon</span></foreignObject>
                                                <foreignObject style="overflow: visible;" x="157.94270833333331"
                                                               y="255.0625" width="107.94270833333333" height="20"><span
                                                        class="ct-label ct-horizontal ct-end"
                                                        xmlns="http://www.w3.org/2000/xmlns/"
                                                        style="width: 108px; height: 20px;">Tue</span></foreignObject>
                                                <foreignObject style="overflow: visible;" x="265.88541666666663"
                                                               y="255.0625" width="107.94270833333334" height="20"><span
                                                        class="ct-label ct-horizontal ct-end"
                                                        xmlns="http://www.w3.org/2000/xmlns/"
                                                        style="width: 108px; height: 20px;">Wed</span></foreignObject>
                                                <foreignObject style="overflow: visible;" x="373.828125" y="255.0625"
                                                               width="107.94270833333331" height="20"><span
                                                        class="ct-label ct-horizontal ct-end"
                                                        xmlns="http://www.w3.org/2000/xmlns/"
                                                        style="width: 108px; height: 20px;">Thu</span></foreignObject>
                                                <foreignObject style="overflow: visible;" x="481.7708333333333"
                                                               y="255.0625" width="107.94270833333331" height="20"><span
                                                        class="ct-label ct-horizontal ct-end"
                                                        xmlns="http://www.w3.org/2000/xmlns/"
                                                        style="width: 108px; height: 20px;">Fri</span></foreignObject>
                                                <foreignObject style="overflow: visible;" x="589.7135416666666"
                                                               y="255.0625" width="107.94270833333337" height="20"><span
                                                        class="ct-label ct-horizontal ct-end"
                                                        xmlns="http://www.w3.org/2000/xmlns/"
                                                        style="width: 108px; height: 20px;">Sat</span></foreignObject>
                                                <foreignObject style="overflow: visible;" x="697.65625" y="255.0625"
                                                               width="30" height="20"><span
                                                        class="ct-label ct-horizontal ct-end"
                                                        xmlns="http://www.w3.org/2000/xmlns/"
                                                        style="width: 30px; height: 20px;">Sun</span></foreignObject>
                                                <foreignObject style="overflow: visible;" y="220.6796875" x="10"
                                                               height="29.3828125" width="30"><span
                                                        class="ct-label ct-vertical ct-start"
                                                        xmlns="http://www.w3.org/2000/xmlns/"
                                                        style="height: 29px; width: 30px;">$0k</span></foreignObject>
                                                <foreignObject style="overflow: visible;" y="191.296875" x="10"
                                                               height="29.3828125" width="30"><span
                                                        class="ct-label ct-vertical ct-start"
                                                        xmlns="http://www.w3.org/2000/xmlns/"
                                                        style="height: 29px; width: 30px;">$5k</span></foreignObject>
                                                <foreignObject style="overflow: visible;" y="161.9140625" x="10"
                                                               height="29.3828125" width="30"><span
                                                        class="ct-label ct-vertical ct-start"
                                                        xmlns="http://www.w3.org/2000/xmlns/"
                                                        style="height: 29px; width: 30px;">$10k</span></foreignObject>
                                                <foreignObject style="overflow: visible;" y="132.53125" x="10"
                                                               height="29.3828125" width="30"><span
                                                        class="ct-label ct-vertical ct-start"
                                                        xmlns="http://www.w3.org/2000/xmlns/"
                                                        style="height: 29px; width: 30px;">$15k</span></foreignObject>
                                                <foreignObject style="overflow: visible;" y="103.1484375" x="10"
                                                               height="29.3828125" width="30"><span
                                                        class="ct-label ct-vertical ct-start"
                                                        xmlns="http://www.w3.org/2000/xmlns/"
                                                        style="height: 29px; width: 30px;">$20k</span></foreignObject>
                                                <foreignObject style="overflow: visible;" y="73.765625" x="10"
                                                               height="29.3828125" width="30"><span
                                                        class="ct-label ct-vertical ct-start"
                                                        xmlns="http://www.w3.org/2000/xmlns/"
                                                        style="height: 29px; width: 30px;">$25k</span></foreignObject>
                                                <foreignObject style="overflow: visible;" y="44.3828125" x="10"
                                                               height="29.3828125" width="30"><span
                                                        class="ct-label ct-vertical ct-start"
                                                        xmlns="http://www.w3.org/2000/xmlns/"
                                                        style="height: 29px; width: 30px;">$30k</span></foreignObject>
                                                <foreignObject style="overflow: visible;" y="15" x="10"
                                                               height="29.3828125" width="30"><span
                                                        class="ct-label ct-vertical ct-start"
                                                        xmlns="http://www.w3.org/2000/xmlns/"
                                                        style="height: 29px; width: 30px;">$35k</span></foreignObject>
                                                <foreignObject style="overflow: visible;" y="-15" x="10" height="30"
                                                               width="30"><span class="ct-label ct-vertical ct-start"
                                                                                xmlns="http://www.w3.org/2000/xmlns/"
                                                                                style="height: 30px; width: 30px;">$40k</span>
                                                </foreignObject>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
