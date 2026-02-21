<div class="subscription-overlay" id="subscriptionOverlay">
    <div class="subscription-modal">
        <button class="close-subscription" id="closeSubscription">
            <i class="fa-solid fa-times"></i>
        </button>

        <div class="subscription-header">
            <div class="subscription-icon">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
            <h3>Stay Updated on Africa's Transformation</h3>
            <p class="subscription-reason">Subscribe to receive exclusive updates on Agenda 2063 progress, flagship
                projects, success stories, and opportunities to contribute to Africa's development journey.</p>
        </div>

        <form class="subscription-form" id="subscriptionForm">
            <div class="form-group">
                <label for="subEmail">Email Address *</label>
                <input type="email" id="subEmail" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for "subName">Full Name *</label>
                <input type="text" id="subName" name="name" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label for="subCountry">Country</label>
                <select id="subCountry" name="country">
                    <option value="">Select your country</option>
                    <option value="algeria">Algeria</option>
                    <option value="angola">Angola</option>
                    <option value="benin">Benin</option>
                    <option value="botswana">Botswana</option>
                    <option value="burkina-faso">Burkina Faso</option>
                    <option value="cameroon">Cameroon</option>
                    <option value="egypt">Egypt</option>
                    <option value="ethiopia">Ethiopia</option>
                    <option value="ghana">Ghana</option>
                    <option value="kenya">Kenya</option>
                    <option value="morocco">Morocco</option>
                    <option value="nigeria">Nigeria</option>
                    <option value="rwanda">Rwanda</option>
                    <option value="senegal">Senegal</option>
                    <option value="south-africa">South Africa</option>
                    <option value="tanzania">Tanzania</option>
                    <option value="uganda">Uganda</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="subscription-interests">
                <label>I'm interested in: (Select all that apply)</label>
                <div class="interest-checkboxes">
                    <label class="interest-checkbox">
                        <input type="checkbox" name="interests" value="progress-reports">
                        <span>Progress Reports</span>
                    </label>
                    <label class="interest-checkbox">
                        <input type="checkbox" name="interests" value="flagship-projects">
                        <span>Flagship Projects</span>
                    </label>
                    <label class="interest-checkbox">
                        <input type="checkbox" name="interests" value="events">
                        <span>Events & Conferences</span>
                    </label>
                    <label class="interest-checkbox">
                        <input type="checkbox" name="interests" value="opportunities">
                        <span>Opportunities</span>
                    </label>
                    <label class="interest-checkbox">
                        <input type="checkbox" name="interests" value="success-stories">
                        <span>Success Stories</span>
                    </label>
                    <label class="interest-checkbox">
                        <input type="checkbox" name="interests" value="research">
                        <span>Research & Publications</span>
                    </label>
                </div>
            </div>

            <div class="subscription-benefits">
                <h4>What You'll Get:</h4>
                <ul>
                    <li><i class="fa-solid fa-check-circle"></i> Monthly progress updates on Agenda 2063 implementation</li>
                    <li><i class="fa-solid fa-check-circle"></i> Early access to reports and publications</li>
                    <li><i class="fa-solid fa-check-circle"></i> Invitations to continental events and webinars</li>
                    <li><i class="fa-solid fa-check-circle"></i> Opportunities to contribute to Africa's transformation</li>
                </ul>
            </div>

            <button type="submit" class="subscribe-btn">
                <i class="fa-solid fa-paper-plane"></i> Subscribe Now
            </button>

            <p class="subscription-privacy">
                We respect your privacy. Unsubscribe anytime. <a href="#">Privacy Policy</a>
            </p>
        </form>
    </div>
</div>
