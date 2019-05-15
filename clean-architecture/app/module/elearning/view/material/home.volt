{% include 'part/header.volt' %}

  <div class="container">
    <div class="section">

      <div class="row">
        <form class="col s6 offset-s3 card" action="material" method="POST">
            <br><br>
            <div class="row center">
                <span class="card-title blue-text">Add Material</span>
            </div>
            <div class="row">
                {% if courses|length > 0 %}
                <div class="input-field col s8 offset-s2">
                    <select name="courseId">
                        {% for key, course in courses %}
                        <option value="{{course.id}}" {% if key == 0 %} selected {% endif %}>{{ course.courseId }}</option>
                        {% endfor %}
                    </select>
                    <label>Parent Course</label>
                </div>
                <div class="input-field col s8 offset-s2">
                    <input name="title" id="name" type="text" class="validate">
                    <label for="name">Title</label>
                </div>
                <div class="input-field col s8 offset-s2">
                    <textarea name="description" id="textarea1" class="materialize-textarea"></textarea>
                    <label for="textarea1">Description</label>
                </div>
            </div>
            <div class="row center">
                <button class="waves-effect waves-light btn blue" type="submit">Add</button>
            </div>
            {% else %}
            <div class="row center">
                <div class="title red-text">No Course Available!</div>
            </div>
            {% endif %}
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
