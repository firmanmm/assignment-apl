{% include 'part/header.volt' %}

  <div class="container">
    <div class="section">

      <div class="row">
        <form class="col s6 offset-s3 card" action="/student" method="POST">
            <br><br>
            <div class="row center">
                <span class="card-title blue-text">Add Student</span>
            </div>
            <div class="row">
                <div class="input-field col s8 offset-s2">
                    <input name="student_id" id="student_id" type="text" class="validate">
                    <label for="student_id">Student ID</label>
                </div>
                <div class="input-field col s8 offset-s2">
                    <input name="name" id="name" type="text" class="validate">
                    <label for="name">Name</label>
                </div>
                <div class="input-field col s8 offset-s2">
                    <input name="password" id="password" type="password" class="validate">
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="row center">
                <button class="waves-effect waves-light btn blue" type="submit">Add</button>
            </div>
        </form>
      </div>

    </div>
    <br><br>
  </div>

<div class="container">
    <div class="section">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Student ID</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>

{% include 'part/footer.volt' %}
