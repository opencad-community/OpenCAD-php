
# Permissions
___
### Table of Contents
- [Home](README.md)
- [Prerequisite](prerequisite.md)
- [Installation](installation.md)
- [__Pemissions__](permissions.md)
- [Support](support.md)
___

Permissions in openCAD are binary values, No (0) and Yes (1). The tables below describe what abilities each user group possess. There are 3 user groups in addition to the meta group "user". The "user" has the ability to edit any assets they directly own, this includes their profile, NCIC Identity, vehicle registrations. The user cannot edit their citations or warrants. The non-meta groups include Head Administrator, Administrator, Moderator.

# Administrative Permissions
|Permission                      | Head Administrator    |Administrator         |Mod                    |
|--------------------------------|-----------------------|----------------------|-----------------------|
| Approve Members                 | Yes                   | Yes                  | Yes                   |
| Delete  Members                 | Yes                   | Yes                  | No                    |
| Edit Users                      | Yes                   | Yes                  | No                    |
| Permanently Ban Users           | Yes                   | Yes                  | No                    |
| Temporarily Ban Users (2 days)  | Yes                   | Yes                  | No                    |

- The temp ban has a default of two (2) days but can be configured by Head Administrators. This is useful for banning a member that has been committing FailRP or someone that is breaking guidelines pertaining to things such as Radio Traffic Etiquette.

# NCIC/Civilian Database Permissions
|Permission             | Head Administrator   |Administrator         |Mod                   | Identity Owner  |
|-----------------------|----------------------|----------------------|----------------------|-----------------|
| Create Identities      | Yes                  | Yes                  | Yes                  | Yes (Owned)     |
| Edit Identities        | Yes                  | Yes                  | No                   | Yes (Owned)     |
| Delete Identities      | Yes                  | No                   | No                   | Yes (Owned)     |
