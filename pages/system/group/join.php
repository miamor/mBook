<?php
if (!$group->isMember) {
	echo ($group->join()) ? 1 : 0;
} else {
	echo ($group->leave()) ? 1 : 0;
}
