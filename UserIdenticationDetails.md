
# Introduction #
When using the module one of the key features is understanding how the OLSA server "knows" who the user is, this is all achieved using the OLSA servers support for AICC.

When a user launches a Skillsoft asset from Moodle, what they are actually doing is performing an "AICC" launch.

_Note: The module does not uses Moodles AICC code_

OLSA gets the minimum details it needs to create a user by parsing the AICC response from Moodle.

# Specifics #
Here we will look in detail at the data exchange, and we will use the Track to OLSA mode to demonstrate.
<br>
<img src='http://sites.google.com/site/moodleskillsoftactivity/images/TrackToOLSA.jpg' />
<br>
The sequence diagram shows the various stages of the communication between the users ‘Browser’ and the key components in the system when tracking to OLSA using AICC.<br>
<br>
To fully understand this sequence you need to be familiar with how AICC HACP communications works, and so please review Appendix A: HTTP-based CMI Protocol  of the CMI001 - AICC/CMI Guidelines For Interoperability  v3.5 <a href='http://www.aicc.org/pages/down-docs-index.htm#cmi001'>http://www.aicc.org/pages/down-docs-index.htm#cmi001</a>

The diagram is split between Intranet and Internet, to show that OLSA will work even if the user and the LMS are behind a corporate firewall and so not visible to the Internet. It can just as easily all be on the Internet. It can not however all be on the Intranet - OLSA is a hosted only solution.<br>
<br>
The reason that this works behind the firewall is because of the use of Signed Java Applets, that are able to communicate to any ‘server’ the users browser can see - so in this example the LMS server that is behind the firewall and the OLSA server that is on the Internet.<br>
<br>
<h1>Key Notes</h1>
<ol><li>The ‘launchurl’ for the course stored in the Skillsoft Activity in Moodle points to a URL on the OLSA server.<br>
</li><li>The OLSA RO Applet performs a GETPARAM to retrieve the details from Moodle and then immediately submits a PUTPARAM request containing the minimal HACP data configured in OLSA. Finally it submits an EXITAU this effectively completes the involvement of the Moodle.<br>
</li><li>The OLSA SIGNON request uses the student_id and student_name values retrieved from Moodle using the GETPARAM request and the course details retrieved by the OLSA RO Applet from the OLSA server. All users are created in the Skillsoft group, this can not be changed.<br>
<ol><li>Depending on the setting chosen for <a href='configuration#Moodle/_Skillsoft_User_Identifier_.md'>Skillsoft_useridentifier</a> the student_id is either the Moodle unique internal user->id value or the Username user->username, this value is used as the ‘username’ in the OLSA server.<br>
</li><li>Depending on the setting chosen for Single SignOn? Account Prefix the value maybe be prefixed.<br>
</li><li>The student_name is the Moodle user->lastname and user->firstname<br>
</li></ol></li><li>The SIGNON request is in effect a redirect to the course requested and now when launched the Skillsoft Course communicates with the OLSA server. Optionally the SIGNON request can open an ‘intermediate’ page that allows the user to download the course.