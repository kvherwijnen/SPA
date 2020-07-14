import archetypesMap from './archetypes';
import zonesMap from "./zones";
import settingsMap from "./settings";
import routinesMap from "./routines";
import scenesMap from "./scenes";
import tabBarMap from "./tab-bar";
import UIControlsMap from "./ui-controls";
import bulbsMap from "./bulbs";
import groupsMap from "./groups";

const libs = [groupsMap, archetypesMap, bulbsMap, UIControlsMap, tabBarMap, scenesMap, routinesMap, settingsMap, zonesMap];
const choiceMap = [];

libs.forEach(lib => {
    lib.forEach(item => choiceMap.push(item))
});

export const choices = choiceMap;

export default choices;
