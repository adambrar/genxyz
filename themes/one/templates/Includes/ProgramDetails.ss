<% if Program %>
    <h4 class="text-center">$Program.ProgramName.Name</h4>
    <p class="text-center"><strong>Summary:</strong> $Program.ProgramName.Summary</p>
    <h4 class="text-center">Levels offered</h4>
    <ul class="list-unstyled text-right">
        <li><strong>Certificate:</strong> <%if Program.CertificateLink %>Offered<br/><a class="btn btn-info" href="$Program.CertificateLink">Find out more</a><% else %>Not offered<% end_if %></li>
        <li><strong>Diploma:</strong> <%if Program.DiplomaLink %>Offered<br/><a class="btn btn-info" href="$Program.DiplomaLink">Find out more</a><% else %>Not offered<% end_if %></li>
        <li><strong>Degree:</strong> <%if Program.DegreeLink %>Offered<br/><a class="btn btn-info" href="$Program.DegreeLink">Find out more</a><% else %>Not offered<% end_if %></li>
        <li><strong>Masters:</strong> <%if Program.MastersLink %>Offered<br/><a class="btn btn-info" href="$Program.MastersLink">Find out more</a><% else %>Not offered<% end_if %></li>
        <li><strong>Doctorate:</strong> <%if Program.DoctorateLink %>Offered<br/><a class="btn btn-info" href="$Program.DoctorateLink">Find out more</a><% else %>Not offered<% end_if %></li>
    </ul>
<% else %>
    <h4 class="text-center">Program Summary</h4>
    <p>Select a program to see a summary</p>
    <h4 class="text-center">Program Levels with Links</h4>
    <ul class="list-unstyled">
        <li><p>Select a program to see what levels this school offers and to get access to links to these program descriptions.</p></li>
    </ul>
<% end_if %>