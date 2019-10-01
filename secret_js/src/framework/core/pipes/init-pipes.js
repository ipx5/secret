import {_} from "../../tools/util";
import { pipesFactory } from "framework/core/pipes/pipesFactory";

export function initPipes(pipes) {
    if (_.isUndefined(pipes)) return

    pipes.forEach(p => pipesFactory.registerPipe(p))
}