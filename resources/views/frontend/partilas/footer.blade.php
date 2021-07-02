<div class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset('uploads/default/book-logo.jpg') }}" class="logo-image">
                <p>
                    <address>
                        Uttara, Dhaka-1300
                        <br>
                        Dhaka, Banglasesh
                    </address>
                    <p>Email: <a href="mailto:mrhninfo@gmail.com">mrhninfo@gmail.com</a></p>
                    <p>Phone: <a href="tel:01622825992">01622825992</a></p>
                </p>
            </div>

            <div class="col-md-3">
                <h4>Top Links</h4><hr>
                <ul>
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="{{ route('user.book.list') }}">Book</a></li>
                    <li><a href="">About Us</a></li>
                    <li><a href="">Contact Us</a></li>
                </ul>
            </div>


            <div class="col-md-3">
                <h4>Top Links</h4><hr>
                <ul>
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Create New Account</a></li>
                    <li><a href="">Privacy Policy</a></li>
                </ul>
            </div>

            <div class="col-md-3">
                <h4>Top Links</h4> <hr>
                <ul class="list-unstyled">
                    <li><a href="https://www.facebook.com/HridoyMrhn/"><i class="fab fa-facebook"></i> Facebook</a></li>
                    <li><a href="https://github.com/HridoyMrhn"><i class="fab fa-github"></i> Github</a></li>
                    <li><a href="https://www.instagram.com/hridoymrhn/"><i class="fab fa-instagram"></i> Instragram</a></li>
                    <li><a href="https://www.linkedin.com/in/hridoymrhn/"><i class="fab fa-linkedin-in"></i> Linkedin</a></li>
                    <li><a href="https://twitter.com/hridoy_mrhn"><i class="fab fa-twitter"></i> Twitter</a></li>
                </ul>
            </div>

        </div>

        <p class="text-center">
            &copy; 2019 all rights reserved
        </p>
    </div>
</div>

<script src="{{ asset('frontend/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
<!-- Select 2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- CKE editor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
@yield('js')

</body>
</html>
