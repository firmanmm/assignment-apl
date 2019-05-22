{% include 'part/header.volt' %}

  <div class="container">
    <div class="section">

      <div class="row">
        <form class="col s6 offset-s3 card" action="" method="POST">
            <br><br>
            <div class="row center">
                <span class="card-title blue-text">Enrollment</span>
            </div>
            <div class="row center">
                <span class="card-title blue-text">Student</span>
            </div>
            <div class="row">
                <div class="input-field col s8 offset-s2">
                    <select name="studentId">
                        {% for key, student in students %}
                        <option value="{{student["id"]}}" {% if key == 0 %} selected {% endif %}>{{ student["studentId"] }} - {{ student["name"] }}</option>
                        {% endfor %}
                    </select>
                    <label>Student ID</label>
                </div>
            </div>
            <div class="row center">
                    <span class="card-title blue-text">Course</span>
                </div>
                <div class="row">
                    <div class="input-field col s8 offset-s2">
                        <select name="courseId">
                            {% for key, course in courses %}
                            <option value="{{course["id"]}}" {% if key == 0 %} selected {% endif %}>{{ course["courseId"]}}</option>
                            {% endfor %}
                        </select>
                        <label>Student ID</label>
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
{% include 'part/footer.volt' %}
