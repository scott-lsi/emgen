# emgen

## An e-mail template generator

---

A Laravel app allowing you to concatenate HTML strings together to form email templates while making use of common parts.

Containing three main models, with relations between them:

* Person
* Template
* TemplatePart

A template is built up of many template parts. A person can have many templates attached to them.

Create template parts, create a template of these parts, create a person and choose their templates.

Click the big blue button and it'll loop through every person and their templates and save them as html files.
