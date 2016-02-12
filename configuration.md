
# Introduction #

The configuration options for the module allow you to enter the details of OLSA Server your organisation is using, choose how often old sessionids are purged from the database and configure the tracking mode for the courses.

http://sites.google.com/site/moodleskillsoftactivity/images/Capture3.PNG
# Settings #
## Skillsoft OLSA EndPoint ##
This is URL to the Web Services and is unique for each customer. This value is supplied by Skillsoft when you have licensed OLSA.

## Skillsoft OLSA Customer ID ##
This is OLSA Customer ID and is unique for each customer. This value is supplied by Skillsoft when you have licensed OLSA.

## Skillsoft OLSA Shared Secret ##
This is OLSA Shared Secret and is unique for each customer. This value is supplied by Skillsoft when you have licensed OLSA.

## Number of hours to keep sessionid ##
Every time a user launches an asset a new unique sessionid is created for session tracking purposes, this value determines how often the completed sessions are purged from the database. The purpose is to keep the database table size as small as possible.

## Skillsoft Tracking Mode ##
This determines where asset usage data is returned. With "Track to LMS" the aicc usage data for an asset, such as score, time spent is immediately sent to Moodle.

With "Track to OLSA" mode the data is initially stored in SkillSoft's servers, making advanced functionality such as download support available, and then the data is automatically synchronised back to Moodle during the Moodle CRON cycle.

There are two options, using the SkillSoft's OnDemandCommunications mode or using a Custom Report.

## Moodle/Skillsoft User Identifier ##
This option determines which value from Moodle is used for the OLSA Username, this is critical when "Track to OLSA" is used to allow synchronisation of data.

You can choose between using the Moodle generated unique user id `user->id` or the Moodle Username `user->username`.

There are benefits to using the unique Moodle generated user id, especially when using "Track To OLSA" mode. This is because this value remians the same even if the users username in Moodle is changed, and thus ensures only one account exists in the OLSA server. If we use the users username, and it is changed a new account would be created in OLSA for this new username resulting in two accounts on the OLSA server.

The benefit of using the username, is that it makes it easier to use "Track to OLSA" mode when potentially user could be accessing the OLSA server via multiple points of entry for example SkillSofts Skillport LMS, via additional portal integrations etc. So long as the "username" in all these systems is the same there will be a single record for the user in OLSA and a thus one consistent usage record. This means that if a user accesses an Asset in Moodle and say completes 50%, if they then access from Skillport using same username the asset will show that 50% completion and if they then complete it in Skillport that completion will be synched to Moodle.

Read [UserIdenticationDetails](UserIdenticationDetails.md) to understand how the id is retrieved from Moodle

**IMPORTANT: If the Moodle username is used, the username must also be  valid as an AICC CMIIdentifier value as defined by the AICC guidlines. Which means the only valid characters outside of A-Z (case insensitive) and 0-9, are a dash `-` (or hyphen) and the underscore `_` character. This means an email address is invalid as it contains the @ symbol and periods (.)**

**IMPORTANT: Introduced in v2013051400 a new setting "Enforce Strict AICC student\_id format" allows this strict checking to be disabled**

## Skillsoft Default Group List ##
This option configures the default groupcodes used when utilising the new seamless login to Skillport option.

When using Track to OLSA there is a new special assetid 'SSO' this assetid when used will create a new activity that allows the user to be seamlessly logged into the Skillport platform.

The seamless login will create a user in Skillport if they do not exist and set the Skillport username based on the Moodle/Skillsoft User Identifier setting above.

The Skillport user account for new user and existing Skillport users will be updated to with the Moodle users first name, last name and email.

For new users the Skillport group membership is controlled by this setting in Moodle. Any users that needs to be created in Skillport will automatically be members of the groups defined here.

Existing users group membership will be unchanged.

## Account Prefix ##
The value entered here is append to the front of the Moodle/Skillsoft User Identifier, both for any launch type.

So for example if this is set to `CUSTOMERX_` and the Moodle Username is the identifier, for user martin the Skillport username would be `CUSTOMERX_martin`.

## Use OLSA SSO ##
This setting determines whether content is launched using AICC mode or whether all launches use the Single SignOn URL defined below. In most instances it is recommended to use the AICC launch method but in some instances SSO may be preferable, this is because with SSO Moodle could be configured to point at perhaps an existing SSO process to Skillport in place in the business.

## Single SignOn Url ##
This is the Url that the user is directed to when Use OLSA SSO mode is used. The page the Url directs to is responsible for determining username to send to Skillsoft.

This feature is especially useful if the customer has already implemented SSO to Skillport in their environment, as they can reuse this existing functionality.

## Select the OLSA Action Type ##
When using SSO mode the administrator can choose to "launch" the asset without displaying the Skillport UI or log the user into Skillport UI on the "Summary Page" for the asset.

The end result for each action type is dependant on certain settings in Skillport, see [actiontyperesults](actiontyperesults.md)

## Custom Report Start Date ##
When using the "Track to OLSA - Custom Report" mode this value is used to set the start date for the report range. The end date is always the previous day unless Custom Report Include Todays Data is selected.

If left blank ALL usage data from Skillsoft is retrieved, this is particularly useful for importing historical data into Moodle for usage already generated in Skillport.

## Custom Report Include Todays Data ##
When not selected the custom report will retrieve data upto and including the previous day. This option makes the report retrieve data including todays data.

With this set the custom report method can be called multiple times during the same day and new usage is continually retrieved.

## Clear the cached WSDL files ##
To speed up the creation of the SOAP Client the code keeps a local copy of the WSDL and assoicated files it downloads from the OLSA site and uses these. If for some reason the download gets corrupted, or you upgrade the version of OLSA you are using you can use this setting to force a fresh download. After the download succeeds the setting is automatically disabled.

## Disable the usage data task ##
When using "Track To OLSA" mode everytime the Moodle CRON task runs the codes syncronisation of usage data will be triggered, this setting allows you to disable this feature.

## Reset the custom report cycle ##
When using "Track to OLSA (Custom Report)" there are a number of steps for the process, each run happends in sequence during the CRON process, so in total 5 CRON cycles are needed to complete a full download.
  1. RUN - Request the report be generated by the OLSA Server
  1. POLL - Check the report is ready
  1. DOWNLOAD - Retrieve the report from the OLSA Server and store locally
  1. IMPORT - Import the report data into Moodle's database
  1. PROCESS - Add the usage data to the users and activities in Moodle.

If the cycle locks, due to perhaps a failed report generation step, the code would hang continually trying to POLL during the next cycle.

This setting allows you to rest the process. After the first CRON run resubmits the RUN request after you set this the setting is automatically disabled.

## Enforce Strict AICC student\_id format ##
v2013051400+

The module implements the AICC 2.2 standard for the student\_id value, this means that valid values are only `[A-Za-z0-9\-_:]`.

When using the Moodle Username as the identifier this can cause issues if the Moodle username is for example an email address as the @ symbol and . are not allowed by the AICC 2.2 standard.

When disabled the strict checking on the student\_id is disabled.

## Default window settings for AICC launches ##
v2014051300+

This setting allows the admin to specify the windows settings used for the AICC "popup" window.

Default is width=800,height=600

For information on the options see https://developer.mozilla.org/en-US/docs/Web/API/Window.open and the strWindowFeatures information.