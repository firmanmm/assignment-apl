{% include 'part/header.volt' %}

  <div class="container">
    <div class="section">

      <div class="row">
        <form class="col s6 offset-s3 card" action="" method="POST">
            <br><br>
            <div class="row center">
                <span class="card-title blue-text">{{source["courseId"]}}'s QRCode</span>
            </div>

            {% if courses|length > 0 %}
            <div class="input-field col s8 offset-s2">
                <select name="courseId">
                    {% for key, course in courses %}
                    <option value="{{course["id"]}}" {% if key == 0 %} selected {% endif %}>{{ course["courseId"] }}</option>
                    {% endfor %}
                </select>
                <label>Target Course</label>
            </div>
            
            {% else %}
            <div class="row center">
                <div class="title red-text">No Course Available!</div>
            </div>
            {% endif %}

            <div class="container">
                <div class="section">
                    <table>
                        <thead>
                            <tr>
                                <th>Include</th>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                            {% for material in materials %}
                            <tr>
                                <td><label>
                                        <input type="checkbox" class="filled-in" name="materials[]" value="{{material['id']}}"/>
                                        <span></span>
                                      </label></td>
                                <td>{{ material["id"] }}</td>
                                <td>{{ material["title"] }}</td>
                                <td>{{ material["description"] }}</td>
                            </tr>
                            {% endfor %}
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row center">
                <button type="submit" class="waves-effect waves-light btn blue" href="/course/{{ course['id'] }}/migrate">Migrate</button>
            </div>
        </form>
      </div>

    </div>
    <br><br>
  </div>

{% include 'part/footer.volt' %}
