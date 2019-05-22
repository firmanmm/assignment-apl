{% include 'part/header.volt' %}

  <div class="container">
    <div class="section">

      <div class="row">
        <form class="col s6 offset-s3 card" action="" method="POST">
            <br><br>
            <div class="row center">
                <span class="card-title blue-text">{{course["courseId"]}}'s QRCode</span>
            </div>
            <div class="row center">
                <img src="{{qrCode}}"><br>
                <a class="waves-effect waves-light btn blue" href="/course/{{ course['id'] }}/migrate">Migrate</a>
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
                    <td>{{ student["id"] }}</td>
                    <td>{{ student["name"] }}</td>
                    <td>{{ student["studentId"] }}</td>
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
                    <td>{{ material["id"] }}</td>
                    <td>{{ material["title"] }}</td>
                    <td>{{ material["courseId"] }}</td>
                    <td>{{ material["description"] }}</td>
                </tr>
                {% endfor %}
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>
{% include 'part/footer.volt' %}
