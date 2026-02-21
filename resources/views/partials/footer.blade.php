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
    use Illuminate\Support\Str;
    $groups = [
        'about' => 'About',
        'resources' => 'Resources',
        'legal' => 'Legal',
        'social' => 'Social',
    ];
    $footerLinks = $footerLinks ?? collect();
    $iconMap = [
        'facebook' => 'facebook-f',
        'twitter' => 'twitter',
        'youtube' => 'youtube',
        'instagram' => 'instagram',
        'linkedin' => 'linkedin',
    ];
@endphp
<footer class="main-footer">
    <div class="footer-content">
        @forelse($groups as $section => $heading)
            @php $items = $footerLinks->get($section, collect()); @endphp
            @if($items->count())
                <div class="footer-column">
                    <h4>{{ $heading }}</h4>
                    <ul>
                        @foreach($items as $item)
                            <li>
                                <a href="{{ $item->url }}"
                                   target="{{ $item->open_in_new_tab ? '_blank' : '_self' }}"
                                   rel="{{ $item->open_in_new_tab ? 'noopener' : '' }}">
                                    {{ $item->label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @empty
        @endforelse

        @if($footerLinks->isEmpty())
            <!-- Fallback content when no footer links are configured -->
            <div class="footer-column">
                <h4>About Agenda 2063</h4>
                <p>AGENDA 2063 is Africa's blueprint and master plan for transforming Africa into the global powerhouse of the future.</p>
            </div>
            <div class="footer-column">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/about') }}">About Us</a></li>
                    <li><a href="#">Resources</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        @endif
    </div>

    <div class="footer-bottom">
        <div class="footer-social">
            <h4>Follow Us</h4>
            <div class="social-icons">
                @php $social = $footerLinks->get('social', collect()); @endphp
                @forelse($social as $link)
                    @php $key = Str::slug($link->label); $icon = $iconMap[$key] ?? 'link'; @endphp
                    <a href="{{ $link->url }}" target="{{ $link->open_in_new_tab ? '_blank' : '_self' }}" rel="{{ $link->open_in_new_tab ? 'noopener' : '' }}">
                        <i class="fa-brands fa-{{ $icon }}"></i>
                    </a>
                @empty
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                @endforelse
            </div>
        </div>
        <div class="footer-links">
            @php $legal = $footerLinks->get('legal', collect()); @endphp
            @forelse($legal as $link)
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
