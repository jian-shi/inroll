@extends('default')

@section('content')
	<section>
        <div class="row">
            <h3 class="bg-info">Survey Details</h3>
            <div class="form-group">
                <div class="col-sm-12"><label>Description</label><input type="textarea" class="form-control" value="{{$survey->description}}"></div>
                <div class="col-sm-3"><label>Start Date</label><input type="text" class="form-control" value="{{$survey->start_date}}"></div>
                <div class="col-sm-3"><label>End Date</label><input type="text" class="form-control" value="{{$survey->end_date}}"></div>
                <div class="col-sm-3"><label>Number of Questions</label><input type="text" class="form-control" value="{{ $survey->number_of_questions }}"></div>
                <div class="col-sm-3"><label>Is Active</label><input type="text" class="form-control" value="{{$survey->is_open}}"></div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
            <h3>Questions <p class="add_question"> +</p></h3>
                <div class="col-sm-12">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                          <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Collapsible Group Item #1
                            </a>
                          </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
	</section>
@stop
<script src="http://code.jquery.com/jquery.js"></script>
<script>
$(document).ready(function() {
    var x= 1;//question_count
    var y= 1;//question_count
    var wrapper_a         = (".modal-body"); //Fields wrapper
    var wrapper         = ("#questions"); //Fields wrapper
    var add_answer      = (".add_answer"); //Add button ID
    var add_question      = (".add_question"); //Add question ID


    $(add_answer).click(function(e){ //on add input button click
        e.preventDefault();
        y++;
        $(wrapper_a).append('<div class="row voffset2"><div class="col-sm-12"><div class="col-sm-8"><input type="text" class="form-control" name="mytext[]" id="answer_1"></div><div class="col-sm-4"><a href="#" class="add_answer">+</a></div></div></div>'); //add input box
        //<div class="col-sm-12 voffset2"><div class="col-sm-8"><input type="text" class="form-control" name="mytext[]"></div> <div class="col-sm-4"><a href="#" class="remove_field">Remove</a></div></div>
    });

    $(add_question).click(function(e){ //on add input button click
            e.preventDefault();
            x++; //text box increment
            $(wrapper).append('fkfk'); //add input box
        });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).closest('div.col-sm-12').remove(); x--;
    })
});

</script>