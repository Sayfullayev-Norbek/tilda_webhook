<?php
    //  session
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        #terms {
            display: none;
        }

        .custom-form {
            border: 2px solid #241c1c;
            background-color: #f0f0f0;
            box-shadow: 0 4px 8px rgba(29, 24, 24, 0.2);
            padding: 20px;
            border-radius: 8px;
        }

        .form-check-input {
            appearance: none;
            width: 0.9em;
            height: 0.9em;
            border: 1px solid #adb5bd;
            border-radius: 0;
            display: inline-block;
            position: relative;
            cursor: pointer;
            margin-right: 0.5em;
        }

        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }

        .form-check-input:checked::before {
            content: '';
            display: inline-block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color:#fff;
            font-size: 1em;
        }

        .form-check-label {
            cursor: pointer;
        }

    </style>
</head>
<body>

    <div class="container-fluid mt-5 p-4 m-4">
        <div class="container">

            @yield('content')

        </div>
    </div>

    <script>
        // tariff
        const checkboxes = document.querySelectorAll('.single-checkbox');
        const form = document.getElementById('tariffForm');
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    checkboxes.forEach((cb) => {
                        if (cb !== this) cb.checked = false;
                    });
                    checkboxes.forEach((cb) => {
                        if (cb !== this) cb.required = false;
                    });
                } else {
                    const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
                    if (!anyChecked) {
                        checkboxes.forEach((cb) => {
                            cb.required = true;
                        });
                    }
                }
            });
        });

        form.addEventListener('submit', function(event) {
            const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
            if (!anyChecked) {
                alert("Iltimos, kamida bitta tarifni tanlang.");
                event.preventDefault();
            }
        });
    </script>

    <script>
        document.getElementById('showTerms').addEventListener('click', function() {
            var terms = document.getElementById('terms');
            if (terms.style.display === 'none' || terms.style.display === '') {
                terms.style.display = 'block';
            } else {
                terms.style.display = 'none';
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
