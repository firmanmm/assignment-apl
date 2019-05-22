{% include 'part/header.volt' %}
{% include 'material/add_material.volt' %}
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
                    <td>{{ material['id'] }}</td>
                    <td>{{ material['title'] }}</td>
                    <td>{{ material['courseId'] }}</td>
                    <td>{{ material['description'] }}</td>
                </tr>
                {% endfor %}
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>
{% include 'part/footer.volt' %}
