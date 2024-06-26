
    @extends('layouts.modme')

    @section('title')
        Tariff
    @endsection

    @section('content')
        <div class="col-1">

        </div>
        <div class="container justify-content-center col-8">
            <form action="{{ route('tariffStore', ['token' => $token]) }}" method="POST">
                @csrf
                <div class="row justify-content-center mb-3 col-lg-8 mt-4">
                    <div class="form-group custom-form">
                        <h4 class="justify-content-center">Tariffni tanlang</h4>

                        <div class="form-check mb-3">
                            <input class="form-check-input single-checkbox" type="checkbox" name="tariff" id="option1" value="zo'r" required>
                            <label class="form-check-label" for="option1">
                                Leadlar soni 249 ta va undan yuqori yani cheklanmagan 1000$
                            </label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input single-checkbox" type="checkbox" name="tariff" id="option2" value="o'rtacha" required>
                            <label class="form-check-label" for="option2">
                                Leadlar soni 100-249 tagacha 100$
                            </label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input single-checkbox" type="checkbox" name="tariff" id="option3" value="arzon" required>
                            <label class="form-check-label" for="option3">
                                Leadlar soni 99 tagacha tekin
                            </label>
                        </div>

                    </div>
                    <div class="form-group mt-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" name="terms" type="checkbox" id="termsCheckbox" required>
                            <label class="form-check-label" for="termsCheckbox">
                                Shartlarga roziman <a href="javascript:void(0)" id="showTerms">Batafsil ...</a>
                            </label>
                        </div>
                        <div id="terms" class="mt-3 mb-3 collapse">
                            <div class="card card-body">
                                <h4>Shartlar</h4>
                                <p>
                                    What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="d-flex mb-3 ">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-1">

        </div>

    @endsection

