{% include 'part/header.volt' %}

  <div class="container">
    <div class="section">

      <div class="row">
        <form class="col s6 offset-s3 card" action="" method="POST">
            <br><br>
            <div class="row center">
                <span class="card-title blue-text">Add Student To {{course.courseId}}</span>
            </div>
            <div class="row">
                <div class="input-field col s8 offset-s2">
                    <select name="studentId">
                        {% for key, student in studentList %}
                        <option value="{{student.studentId}}" {% if key == 0 %} selected {% endif %}>{{ student.studentId }} - {{ student.name }}</option>
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
                {% for student in students %}
                <tr>
                    <td>{{ student.id }}</td>
                    <td>{{ student.name }}</td>
                    <td>{{ student.studentId }}</td>
                </tr>
                {% endfor %}
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>


<div class="container">
    <div class="section">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Course ID</th>
                    <th>Description</th>
                </tr>
            </thead>
                {% for material in materials %}
                <tr>
                    <td>{{ material.id }}</td>
                    <td>{{ material.title }}</td>
                    <td>{{ material.courseId }}</td>
                    <td>{{ material.description }}</td>
                </tr>
                {% endfor %}
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>
{% include 'part/footer.volt' %}
