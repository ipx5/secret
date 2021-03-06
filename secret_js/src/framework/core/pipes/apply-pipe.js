import {pipesFactory} from "framework/core/pipes/pipesFactory";
import {_} from "framework/index";

export function applyPipe(pipeData, value) {
    console.log(pipeData)
    let pipe = pipesFactory.getPipe(pipeData.name);

    if (_.isUndefined(pipe)) throw new Error(`Pipe with name ${pipeData.name} wasn't found`)

    if (_.isUndefined(pipeData.args)) pipeData.args = [];
    return pipe.transform(value, ...pipeData.args)
}