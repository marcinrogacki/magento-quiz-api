<div class="page-header">
    <h1>Add question</h1>
</div>
<form action="addPost" method="post" role="form">

    <input name="question" type="text" placeholder="Question" class="form-control">
    <br />

    <div class="input-group">
      <input name="answer[0]['value']" type="text" placeholder="Answer" class="form-control">
      <span class="input-group-addon">
        <span> valid </span>
        <input name="answer[0]['valid']" type="checkbox">
      </span>
    </div>
    <br />

    <div class="input-group">
      <input name="answer[1]['value']" type="text" placeholder="Answer" class="form-control">
      <span class="input-group-addon">
        <span> valid </span>
        <input name="answer[1]['valid']" type="checkbox">
      </span>
    </div>
    <br />

    <div class="input-group">
      <input name="answer[2]['value']" type="text" placeholder="Answer" class="form-control">
      <span class="input-group-addon">
        <span> valid </span>
        <input name="answer[2]['valid']" type="checkbox">
      </span>
    </div>
    <br />

    <div class="input-group">
      <input name="answer[3]['value']" type="text" placeholder="Answer" class="form-control">
      <span class="input-group-addon">
        <span> valid </span>
        <input name="answer[3]['valid']" type="checkbox">
      </span>
    </div>
    <br />

    <button type="submit" class="btn">Submit</button>
</form>
