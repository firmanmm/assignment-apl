{% include 'part/header.volt' %}

  <div class="container">
    <div class="section">

      <div class="row">
        <form class="col s6 offset-s3 card" action="course" method="POST">
            <br><br>
            <div class="row center">
                <span class="card-title blue-text">Add Course</span>
            </div>
            <div class="row">
                <div class="input-field col s8 offset-s2">
                    <input name="courseId" id="course_id" type="text" class="validate">
                    <label for="course_id">Course ID</label>
                </div>
                <div class="input-field col s8 offset-s2">
                    <input name="name" id="name" type="text" class="validate">
                    <label for="name">Name</label>
                </div>
                <div class="range-field col s8 offset-s2">
                        <label for="capacity">Capacity</label>
                    <input type="range" name="capacity" id="capacity" min="0" max="100" />
                </div>
                <div class="input-field col s8 offset-s2">
                    <textarea name="description" id="textarea1" class="materialize-textarea"></textarea>
                    <label for="textarea1">Description</label>
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
                    <th>Course ID</th>
                    <th>Capacity</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
                {% for course in courses %}
                <tr>
                    <td>{{ course['id'] }}</td>
                    <td>{{ course['courseId'] }}</td>
                    <td>{{ course['capacity'] }}</td>
                    <td>{{ course['description'] }}</td>
                    <td><a class="waves-effect waves-light btn blue" href="course/{{ course['id'] }}">Detail</a></td>
                </tr>
                {% endfor %}
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>

{% include 'part/footer.volt' %}
