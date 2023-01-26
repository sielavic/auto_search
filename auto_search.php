$tasks = Entity\MacrotaskTask::where('points_id', $obj['id'])->where('status', '<=', 2)->get();


                                $count_inic = 0;
                                $count_kur = 0;
                                $perfomers = 0;
                                $watchers_count = 0;

                                if (!empty($tasks)) {
                                    foreach ($tasks as $task) {
                                        if ($task->iniciator == USER_COOKIE_ID) {
                                            $brandPoints[$i]['iniciator'] = $task->iniciator;
                                            $count_inic += 1;
                                        }
                                        if ($task->kurator == USER_COOKIE_ID) {
                                            $brandPoints[$i]['kurator'] = $task->kurator;
                                            $count_kur += 1;
                                        }

                                        $performer = $task->perfs;
                                        foreach ($performer as $perfs) {//получаем исполнителей
                                            if (USER_COOKIE_ID == $perfs->user_id) {
                                                $perfomers += 1;
                                                $brandPoints[$i]['perfomer'] = $perfs->user_id;
                                            }
                                        }

                                        $macrotask = $task->macrotask->where('wrk_type', 'task')->first();
                                        if (!empty($macrotask)) {
                                            $watchers = $macrotask->getProperty('array_user_watcher');
                                            foreach ($watchers as $watcher) {
                                                if (!empty($watcher)) {
                                                    if (USER_COOKIE_ID == $watcher->user_id) {
                                                        $watchers_count += 1;
                                                        $brandPoints[$i]['watcher'] = $watcher->user_id;
                                                    }
                                                }
                                            }
                                        }

                                    }
                                }


                                $brandPoints[$i]['current_tasks'] = $count_inic + $count_kur + $perfomers + $watchers_count;

                            
