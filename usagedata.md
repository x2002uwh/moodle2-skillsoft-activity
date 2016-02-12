
# Introduction #
Skillsoft assets come in two types:

## Fully Trackable ##
These content types will report status, score and session time when accessed.

  * Skillsoft Courses
  * Skillsoft SkillSimulations

## Passive ##
These content types do not record any usage data, but will report fixed valuses for status and session time. These can be configured on the site but are typically incomplete and 00:00:00

  * Books24x7, including LDC and 50Lessons Video content
  * Skillsoft KnowledgeCenters
  * Skillsoft Leadership Advantage
  * Business Impact
  * Challenge Series
  * Learning Sparks
  * Mentored Assets and Mentoring

# When is the data visible in Moodle #
This will depend on the configuration of the [Tracking Mode](configuration#Skillsoft_Tracking_Mode.md).

If this is "Track to LMS" then the results for the assets is immediately returned and record in Moodle.

If either of the "Track to OLSA" modes then the usage data is all stored in Skillsoft OLSA server, and Moodle treats each asset as "passive" recording the fixed values, only when the Moodle CRON job runs and the data is retrieved from Skillsoft will it be visible in Moodle.