<!-- Footer Quiz Gamification Section -->
<section class="footer-quiz-section" id="footerQuizSection">
    <div class="footer-quiz-container">
        <div class="footer-quiz-left">
            <div class="footer-quiz-icon">
                <i class="fa-solid fa-brain"></i>
            </div>
            <div class="footer-quiz-intro">
                <h3>Test Your Knowledge</h3>
                <p>How well do you know Agenda 2063?</p>
            </div>
        </div>
        <div class="footer-quiz-right">
            <!-- Start Form: Collect user info before quiz -->
            <div class="fq-start-form" id="fqStartForm">
                <div class="fq-start-card">
                    <h4 class="fq-start-title"><i class="fa-solid fa-user-plus"></i> Join the Quiz</h4>
                    <p class="fq-start-desc">Enter your details to begin testing your knowledge</p>
                    <form id="fqUserForm">
                        <div class="fq-form-group">
                            <label for="fqName"><i class="fa-solid fa-user"></i> Full Name</label>
                            <input type="text" id="fqName" name="name" placeholder="Enter your full name" required>
                        </div>
                        <div class="fq-form-group">
                            <label for="fqEmail"><i class="fa-solid fa-envelope"></i> Email Address</label>
                            <input type="email" id="fqEmail" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="fq-form-group">
                            <label for="fqCountry"><i class="fa-solid fa-globe-africa"></i> Country</label>
                            <select id="fqCountry" name="country" required>
                                <option value="">Select your country</option>
                                <option value="Algeria">Algeria</option>
                                <option value="Angola">Angola</option>
                                <option value="Benin">Benin</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cabo Verde">Cabo Verde</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                <option value="DR Congo">DR Congo</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Egypt">Egypt</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Eswatini">Eswatini</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libya">Libya</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Mali">Mali</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="São Tomé and Príncipe">São Tomé and Príncipe</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Sudan">South Sudan</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Togo">Togo</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <button type="submit" class="fq-start-btn">
                            <i class="fa-solid fa-play"></i> Start Quiz
                        </button>
                    </form>
                </div>
            </div>

            <!-- Quiz Content (hidden until form is submitted) -->
            <div class="fq-quiz-content" id="fqQuizContent" style="display: none;">
                <div class="footer-quiz-card" id="footerQuizCard">
                    <div class="fq-question" id="fqQuestion">Loading question...</div>
                    <div class="fq-options" id="fqOptions"></div>
                    <div class="fq-feedback" id="fqFeedback" style="display: none;"></div>
                </div>
                <div class="footer-quiz-nav">
                    <div class="fq-counter">
                        <span id="fqCurrent">1</span> / <span id="fqTotal">10</span>
                    </div>
                    <div class="fq-score-inline">
                        <i class="fa-solid fa-star"></i> <span id="fqScore">0</span> correct
                    </div>
                    <button class="fq-next-btn" id="fqNextBtn" disabled>
                        Next <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
@php
    $footerLinks = $footerLinks ?? collect();
    $legalLinks = $footerLinks->get('legal', collect());
    $footerColumns = [
        [
            'title' => 'AU Resources',
            'items' => [
                ['label' => 'AU Website', 'url' => 'https://au.int/en'],
                ['label' => 'AU Handbook', 'url' => 'https://au.int/en/handbook'],
                ['label' => 'AU Bids & Procurement', 'url' => 'https://au.int/en/bids'],
                ['label' => 'AU Library', 'url' => 'https://library.au.int'],
                ['label' => 'AU Careers', 'url' => 'https://jobs.au.int/'],
            ],
        ],
        [
            'title' => 'Programmes & Fellowships',
            'items' => [
                ['label' => 'AU Media Fellowship', 'url' => 'https://au.int/en/aumf'],
                ['label' => 'AU Tech Fellowship', 'url' => 'https://auinnovationfellowship.com/'],
                ['label' => 'AU Internship Programme', 'url' => 'https://au.int/en/internship/apply'],
                ['label' => 'AU Youth Volunteer Corps', 'url' => 'https://go.au.int/en/youth-volunteer-corps'],
            ],
        ],
        [
            'title' => 'AU Partnerships',
            'items' => [
                ['label' => 'AUPReMIS', 'url' => 'https://au.int/en/bids/20231027/premis-terms-reference-tor-consultancy-firm-partners-and-resource-mobilization'],
                ['label' => 'AU Foundation', 'url' => 'https://au.int/en/auf'],
                ['label' => 'Resource Mobilization', 'url' => 'https://au.int/en/auc/priorities/resource-mobilization'],
                ['label' => 'AUDA-NEPAD', 'url' => 'https://au.int/en/nepad'],
            ],
        ],
        [
            'title' => 'AU Social Media Engagements',
            'items' => [
                ['label' => 'Facebook', 'url' => 'https://www.facebook.com/AfricanUnionCommission', 'icon' => 'fa-facebook-f'],
                ['label' => 'X (Twitter)', 'url' => 'https://twitter.com/_AfricanUnion', 'icon' => 'x-twitter'],
                ['label' => 'YouTube', 'url' => 'https://www.youtube.com/AUCommission', 'icon' => 'fa-youtube'],
                ['label' => 'Flickr', 'url' => 'https://www.flickr.com/photos/africanunioncommission/', 'icon' => 'fa-flickr'],
            ],
        ],
    ];
    $iosStoreUrl = config('app.mobile_app.ios_store_url');
    $androidStoreUrl = config('app.mobile_app.android_store_url');
@endphp
<footer class="main-footer">
    <div class="footer-content">
        @foreach($footerColumns as $column)
            <div class="footer-column">
                <h4>{{ $column['title'] }}</h4>
                <ul class="footer-menu">
                    @foreach($column['items'] as $item)
                        <li>
                            <a href="{{ $item['url'] }}" target="_blank" rel="noopener">
                                @if(! empty($item['icon']))
                                    <span class="footer-link-icon">
                                        @if($item['icon'] === 'x-twitter')
                                            <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                            </svg>
                                        @else
                                            <i class="fa-brands {{ $item['icon'] }}"></i>
                                        @endif
                                    </span>
                                @endif
                                <span>{{ $item['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <div class="footer-app-banner">
        <div class="footer-app-copy">
            <h4>Get the Mobile App</h4>
            <p>Mobile App version is available on iOS and Android stores. Tap a store below to go straight to the download page.</p>
        </div>
        <div class="footer-store-links">
            <a class="footer-store-btn ios" href="{{ $iosStoreUrl }}" target="_blank" rel="noopener">
                <span class="footer-store-icon">
                    <i class="fa-brands fa-app-store-ios"></i>
                </span>
                <span class="footer-store-copy">
                    <small>Available on</small>
                    <strong>App Store</strong>
                </span>
            </a>
            <a class="footer-store-btn android" href="{{ $androidStoreUrl }}" target="_blank" rel="noopener">
                <span class="footer-store-icon">
                    <i class="fa-brands fa-google-play"></i>
                </span>
                <span class="footer-store-copy">
                    <small>Get it on</small>
                    <strong>Google Play</strong>
                </span>
            </a>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="footer-links">
            @forelse($legalLinks as $link)
                <a href="{{ $link->url }}" target="{{ $link->open_in_new_tab ? '_blank' : '_self' }}" rel="{{ $link->open_in_new_tab ? 'noopener' : '' }}">{{ $link->label }}</a>
            @empty
                <a href="#">Contact Us</a>
                <a href="#">Cookie Policy</a>
                <a href="#">Privacy Notice</a>
                <a href="#">Site Terms</a>
            @endforelse
        </div>
        <div class="copyright">
            Copyright &copy; Agenda 2063
        </div>
    </div>
</footer>
